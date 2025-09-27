<?php

namespace App\Exports;

use App\Models\PendaftaranDetailModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendaftaranExport implements FromView, ShouldAutoSize, WithStyles, WithCustomStartCell
{
    public function __construct($data, $data2)
    {
        $this->data = $data;
        $this->data2 = $data2;
    }

    // public function drawings()
    // {
    //     $drawing = new Drawing;
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('This is my logo');
    //     $drawing->setPath(public_path("/assets/files/" . $this->data2->foto));
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('A1');

    //     return $drawing;
    // }

    public function startCell(): string
    {
        return 'A7';
    }

    public function styles(Worksheet $sheet)
    {
        $akhir = (count($this->data) + 2);
        $sheet->getStyle('A2:E2')->getFont()->setBold(true);
        $sheet->getStyle("A2:E$akhir")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => [
                        'rgb' => '000000'
                    ]
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
    }



    public function view(): View
    {
        return view('admin.pendaftaran.excel-pendaftaran', [
            'pendaftaran_detail' => $this->data,
            'sekolah' => $this->data2
        ]);
    }
}
