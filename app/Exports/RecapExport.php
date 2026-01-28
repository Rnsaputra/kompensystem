<?php

namespace App\Exports;

use App\Models\Kompensasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class RecapExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $max_col;

    public function __construct()
    {
        // Hitung berapa kolom D maksimal (Total jam tertinggi / 8)
        // Agar header Excel dinamis (D1, D2, D3...)
        $max_hours = Kompensasi::max('total_kompensasi');
        $this->max_col = $max_hours ? ceil($max_hours / 8) : 0;
    }

    public function headings(): array
    {
        $header = ['Nama Mahasiswa', 'NIM', 'Kelas', 'Total Jam'];

        // Loop buat header D1, D2, dst...
        for ($i = 1; $i <= $this->max_col; $i++) {
            $header[] = "D$i";
        }
        return $header;
    }

    public function collection()
    {
        // Ambil data urut sesuai kelas & nama
        $data = Kompensasi::with('mahasiswa')
            ->join('mahasiswas', 'kompensasis.mahasiswa_id', '=', 'mahasiswas.id')
            ->orderBy('mahasiswas.kelas')
            ->orderBy('mahasiswas.nama')
            ->select('kompensasis.*')
            ->get();

        return $data->map(function ($item) {
            $row = [
                $item->mahasiswa->nama,
                $item->mahasiswa->nim,
                $item->mahasiswa->kelas,
                $item->total_kompensasi,
            ];

            // Hitung jatah kotak mahasiswa ini
            $kotak_aktif = ceil($item->total_kompensasi / 8);

            // Loop kolom D
            for ($i = 1; $i <= $this->max_col; $i++) {
                if ($i <= $kotak_aktif) {
                    // Cek apakah hari ini sudah dicentang (completed)?
                    // Mengambil dari kolom JSON completed_days
                    $is_done = in_array($i, $item->completed_days ?? []);
                    $row[] = $is_done ? '✓' : ''; // Tanda centang jika sudah
                } else {
                    $row[] = 'HITAM'; // Tanda khusus untuk diwarnai hitam nanti
                }
            }
            return $row;
        });
    }

    public function styles(Worksheet $sheet)
    {
        // 1. Style Header (Bold, Warna Abu, Tengah)
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E2E8F0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // 2. Loop Cells untuk Pewarnaan Kotak Hitam/Putih
        $lastRow = $sheet->getHighestRow();

        for ($row = 2; $row <= $lastRow; $row++) {
            // Loop Kolom mulai dari E (index 5) dst...
            for ($col = 5; $col <= 4 + $this->max_col; $col++) {

                $colString = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
                $cell = $sheet->getCell($colString . $row);
                $val = $cell->getValue();

                if ($val === 'HITAM') {
                    // KONDISI 1: TIDAK ADA KOMPEN (WARNA HITAM)
                    $cell->setValue(''); // Hapus tulisan HITAM
                    $sheet->getStyle($colString . $row)->applyFromArray([
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E293B']], // Slate-800
                    ]);
                } else {
                    // KONDISI 2: ADA KOMPEN (KOTAK PUTIH + BORDER)
                    $sheet->getStyle($colString . $row)->applyFromArray([
                        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    ]);

                    // Jika isinya centang '✓', kasih warna hijau & bold
                    if ($val === '✓') {
                        $sheet->getStyle($colString . $row)->getFont()->getColor()->setRGB('10B981'); // Emerald-500
                        $sheet->getStyle($colString . $row)->getFont()->setBold(true);
                    }
                }
            }
        }
    }
}
