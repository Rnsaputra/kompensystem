<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Kompensasi;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RecapExport;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Ambil Nilai Pengali
        $config = Configuration::where('key', 'pengali_kompen')->first();
        $nilai_pengali = $config ? $config->value : 2;

        // 2. Query Dasar (Join Mahasiswa)
        $query = Kompensasi::with('mahasiswa')
            ->join('mahasiswas', 'kompensasis.mahasiswa_id', '=', 'mahasiswas.id')
            ->select('kompensasis.*');

        // 3. Logika Sortir
        $sort = $request->get('sort', 'nama'); // Default sort by nama

        switch ($sort) {
            case 'kelas':
                $query->orderBy('mahasiswas.kelas', 'asc')
                    ->orderBy('mahasiswas.nama', 'asc');
                break;
            case 'jam_tinggi':
                $query->orderBy('total_kompensasi', 'desc');
                break;
            case 'jam_rendah':
                $query->orderBy('total_kompensasi', 'asc');
                break;
            default:
                $query->orderBy('mahasiswas.nama', 'asc');
                break;
        }

        $data = $query->get();

        return view('pages.data_kompen.index', compact('data', 'nilai_pengali'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Manual
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'kelas' => 'required',
            'jumlah_alpha' => 'required|numeric|min:0',
        ]);

        // 2. CEK DUPLIKAT DATA KOMPEN
        // Cari apakah NIM ini sudah punya data mahasiswa?
        $mhs = Mahasiswa::where('nim', $request->nim)->first();

        // Jika mahasiswanya ada, DAN sudah punya kompen -> Tolak
        if ($mhs && $mhs->kompensasi) {
            return back()->with('error', 'Gagal! Mahasiswa dengan NIM ' . $request->nim . ' sudah memiliki data kompensasi.');
        }

        // 3. Ambil Rumus
        $config = Configuration::where('key', 'pengali_kompen')->first();
        $pengali_db = $config ? (int)$config->value : 2;

        // 4. Simpan / Update Data Mahasiswa (Tabel Mahasiswas)
        // Kita pakai updateOrCreate: Kalau NIM ketemu, update Namanya (bisa jadi koreksi nama). Kalau gak ketemu, buat baru.
        $mahasiswaBaru = Mahasiswa::updateOrCreate(
            ['nim' => $request->nim],
            [
                'nama' => $request->nama,
                'kelas' => $request->kelas
            ]
        );

        // 5. Simpan Data Kompensasi
        Kompensasi::create([
            'mahasiswa_id' => $mahasiswaBaru->id,
            'jumlah_alpha' => $request->jumlah_alpha,
            'pengali' => $pengali_db,
            'total_kompensasi' => $request->jumlah_alpha * $pengali_db,
            'status' => ($request->jumlah_alpha == 0) ? 'Lunas' : 'Belum Lunas'
        ]);

        return redirect()->route('kompensasi.index')->with('success', 'Data Berhasil Disimpan!');
    }
    public function updatePengali(Request $request)
    {
        //Validasi
        $request->validate(['pengali_baru' => 'required|numeric|min:1']);
        $nilai_baru = $request->pengali_baru;

        // Simpan ke Tabel Konfigurasi (Agar input selanjutnya pakai rumus baru)
        Configuration::updateOrCreate(
            ['key' => 'pengali_kompen'],
            ['value' => $nilai_baru]
        );
        // UPDATE MASSAL
        Kompensasi::query()->update([
            'pengali' => $nilai_baru,
            'total_kompensasi' => DB::raw("jumlah_alpha * $nilai_baru")
        ]);

        return back()->with('success', 'Rumus diperbarui! Seluruh data kompensasi telah dihitung ulang.');
    }
    public function recap(Request $request)
    {
        // 1. Mulai Query dengan Join ke tabel mahasiswa agar bisa sort by Kelas/Nama
        $query = Kompensasi::with('mahasiswa')
            ->join('mahasiswas', 'kompensasis.mahasiswa_id', '=', 'mahasiswas.id')
            ->select('kompensasis.*'); // Penting: Ambil kolom kompensasi saja agar ID tidak bentrok

        // 2. Logika Sortir
        $sort = $request->get('sort', 'nama'); // Default sort by nama

        switch ($sort) {
            case 'kelas':
                // Urutkan Kelas dulu, baru Nama
                $query->orderBy('mahasiswas.kelas', 'asc')
                    ->orderBy('mahasiswas.nama', 'asc');
                break;
            case 'jam_tinggi':
                // Jam Terbanyak di atas
                $query->orderBy('total_kompensasi', 'desc');
                break;
            case 'jam_rendah':
                // Jam Sedikit di atas
                $query->orderBy('total_kompensasi', 'asc');
                break;
            default:
                // Default: Abjad Nama
                $query->orderBy('mahasiswas.nama', 'asc');
                break;
        }

        $data = $query->get();

        // 3. Logika kolom dinamis (tetap sama seperti sebelumnya)
        $max_kompen = $data->max('total_kompensasi');
        $jumlah_kolom = $max_kompen ? ceil($max_kompen / 8) : 0;

        return view('pages.recap.index', compact('data', 'jumlah_kolom'));
    }
    public function toggleDay(Request $request)
    {
        // Validasi
        $request->validate([
            'id' => 'required',
            'day' => 'required'
        ]);

        // Ambil data
        $kompen = Kompensasi::findOrFail($request->id);
        $completed = $kompen->completed_days ?? []; // Ambil array lama
        $day = (int)$request->day;

        // Logika Toggle (Kalau ada hapus, kalau belum ada tambah)
        $kompen = Kompensasi::findOrFail($request->id);
        $completed = $kompen->completed_days ?? [];
        $day = (int)$request->day;

        // Logic Toggle
        if (in_array($day, $completed)) {
            $completed = array_values(array_diff($completed, [$day]));
        } else {
            $completed[] = $day;
        }

        // Logic Otomatis Status Lunas
        // Hitung total kotak yang harus dicentang
        $total_kotak_wajib = ceil($kompen->total_kompensasi / 8);
        // Hitung berapa yang sudah dicentang
        $jumlah_centang = count($completed);

        // Jika jumlah centang >= wajib, maka LUNAS. Jika tidak, BELUM LUNAS.
        $status_baru = ($jumlah_centang >= $total_kotak_wajib) ? 'Lunas' : 'Belum Lunas';

        // 3. Simpan Update
        $kompen->update([
            'completed_days' => $completed,
            'status' => $status_baru
        ]);

        return response()->json([
            'status' => 'success',
            'new_status' => $status_baru
        ]);
    }

    public function exportExcel()
    {
        // Nama file otomatis ada tanggal downloadnya
        return Excel::download(new RecapExport, 'Rekap_Kompensasi_' . date('d-m-Y') . '.xlsx');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'kelas' => 'required',
            'jumlah_alpha' => 'required|numeric|min:0',
        ]);

        // 2. Ambil Data Kompensasi berdasarkan ID
        $kompensasi = Kompensasi::findOrFail($id);

        // 3. Update Data Mahasiswa (Relasinya)
        // Kita akses $kompensasi->mahasiswa lalu update isinya
        $kompensasi->mahasiswa->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'kelas' => $request->kelas,
        ]);

        // 4. Hitung Ulang Total Kompen
        // (Opsional: Ambil rumus terbaru atau tetap pakai rumus lama saat data dibuat? 
        // Di sini saya pakai rumus TERBARU dari config agar update mengikuti aturan sekarang)
        $config = Configuration::where('key', 'pengali_kompen')->first();
        $pengali_saat_ini = $config ? (int)$config->value : 2;

        $total_baru = $request->jumlah_alpha * $pengali_saat_ini;

        // 5. Update Data Kompensasi
        $kompensasi->update([
            'jumlah_alpha' => $request->jumlah_alpha,
            'pengali' => $pengali_saat_ini, // Update pengalinya ke yang baru
            'total_kompensasi' => $total_baru,
            'status' => ($request->jumlah_alpha == 0) ? 'Lunas' : 'Belum Lunas'
        ]);

        return redirect()->route('kompensasi.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Cari data
        $kompensasi = Kompensasi::findOrFail($id);

        // Hapus (Otomatis cascading hapus logic jika diatur di database, 
        // tapi karena kita ingin menghapus Data Kompen-nya saja, cukup delete kompensasi)
        $kompensasi->delete();

        return redirect()->route('kompensasi.index')->with('success', 'Data berhasil dihapus!');
    }
}
