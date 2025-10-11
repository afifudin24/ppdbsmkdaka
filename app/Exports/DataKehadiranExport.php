<?php

namespace App\Exports;

use App\Models\DataKehadiran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataKehadiranExport implements FromView, ShouldAutoSize, WithStyles, WithCustomStartCell
{
    protected $data;
    protected $agenda;

    public function __construct($data, $agenda)
    {
        $this->data = $data;   // Data kehadiran (collection)
        $this->agenda = $agenda; // Informasi agenda
    }

    public function startCell(): string
    {
        // Data tabel akan dimulai dari cell A7 (agar bisa kasih header di atas)
        return 'A7';
    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur gaya border dan alignment tabel
        $akhir = count($this->data) + 2;

        $sheet->getStyle('A2:E2')->getFont()->setBold(true);

        $sheet->getStyle("A2:E$akhir")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
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
        // Mengarahkan ke view Blade untuk Excel export
        return view('admin.agenda_kehadiran.excel', [
            'data_kehadiran' => $this->data,
            'agenda' => $this->agenda,
        ]);
    }
}
