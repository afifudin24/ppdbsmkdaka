<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaExport implements FromView, ShouldAutoSize, WithStyles, WithCustomStartCell
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function startCell(): string
    {
        // Data tabel akan dimulai dari cell A1 saja supaya posisi mudah dikontrol
        return 'A1';
    }

    public function styles(Worksheet $sheet)
    {
        // Hitung jumlah baris (7 kolom dari A sampai G)
        $barisAkhir = count($this->data) + 4; // buffer tambahan biar aman

        // Terapkan border ke seluruh area tabel
        $sheet->getStyle("A1:H$barisAkhir")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Bold untuk baris header (yang punya <th>)
        $sheet->getStyle('A7:G7')->getFont()->setBold(true);

        // Otomatis wrap text biar teks panjang tidak kepotong
        $sheet->getStyle("A1:H$barisAkhir")->getAlignment()->setWrapText(true);
    }

    public function view(): View
    {
        return view('admin.siswa.ekspor', [
            'data_siswa' => $this->data,
        ]);
    }
}
