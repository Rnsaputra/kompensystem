<?php

namespace App\Http\Controllers;

use App\Models\Kompensasi;
use Illuminate\Http\Request;
use App\Models\Configuration;
// use App\Models\Kompen; // Uncomment nanti jika sudah ada Model

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $config = Configuration::where('key', 'pengali_kompen')->first();
        $pengali = $config ? $config->value : 2;

        // 2. Query Dasar
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

        // 4. Hitung Kolom
        $max_kompen = $data->max('total_kompensasi');
        $jumlah_kolom = $max_kompen ? ceil($max_kompen / 8) : 0;

        return view('landing', compact('data', 'jumlah_kolom', 'pengali'));
    }
}
