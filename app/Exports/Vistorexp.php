<?php

namespace App\Exports;

use App\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class Vistorexp implements FromCollection, WithHeadings, WithEvents, WithStyles, WithCustomStartCell, ShouldAutoSize, WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $dr;
    protected $ke;
    public function __construct($dr, $ke)
    {
        $this->dr = $dr;
        $this->ke = $ke;
    }

    public function collection()
    {
        $data = Visitor::select('tanggal', 'hari', 'jam', 'jenis', 'harga')->whereBetween('tanggal', [$this->dr,  $this->ke])->orderby('tanggal', 'ASC')->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            'TANGGAL',
            'HARI',
            'JAM',
            'JENIS',
            'HARGA',
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(storage_path('app/public/public/mobil.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }



    public function startCell(): string
    {
        return 'A6';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
            2 => ['font' => ['bold' => true]],
            6 => ['font' => ['bold' => true]],

            // // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            1 => ['font' => ['size' => 17]],
            2 => ['font' => ['size' => 12]],


        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // $event->sheet->getDelegate()->getHeaderFooter()->setOddHeader('My Header');
                $dr =  Carbon::parse($this->dr)->format('d M Y');
                $ke =  Carbon::parse($this->ke)->format('d M Y');
                $kata1 = "Daftar Laporan kunjungan";
                $kata2 = "Dari tanggal $dr sampai $ke";


                $event->sheet->mergeCells('A1:E1');
                $event->sheet->mergeCells('A2:E2');
                $event->sheet->setCellValue('A1', $kata1);
                $event->sheet->setCellValue('A2', $kata2);
                $cellRange = 'A5:E5'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);
                // $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                // $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(40);
                // $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                // $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                // $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                // $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(30);

                // Apply array of styles to B2:G8 cell range
                $judul = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $event->sheet->getDelegate()->getStyle('A1:E1')->applyFromArray($judul);
                $event->sheet->getDelegate()->getStyle('A2:E3')->applyFromArray($judul);
                $event->sheet->getStyle('A')->getAlignment()->applyFromArray(
                    ['horizontal' => 'center']
                );
                $event->sheet->getStyle('B')->getAlignment()->applyFromArray(
                    ['horizontal' => 'center']
                );
                $event->sheet->getStyle('C')->getAlignment()->applyFromArray(
                    ['horizontal' => 'center']
                );
                $event->sheet->getStyle('D')->getAlignment()->applyFromArray(
                    ['horizontal' => 'right']
                );
                $event->sheet->getStyle('E')->getAlignment()->applyFromArray(
                    ['horizontal' => 'right']
                );




                // Apply array of styles to B2:G8 cell range
                // $styleArray = [
                //     'borders' => [
                //         'outline' => [
                //             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                //             'color' => ['argb' => 'FFFF0000'],
                //         ]
                //     ]
                // ];

                // $event->sheet->getDelegate()->getStyle('B2:G8')->applyFromArray($styleArray);

                // Set first row to height 20
                // $event->sheet->getDelegate()->getRowDimension(3)->setRowHeight(50);

                $event->sheet->getColumnDimension('A')->setAutoSize(false);
                $event->sheet->getColumnDimension('B')->setAutoSize(false);
                $event->sheet->getColumnDimension('C')->setAutoSize(false);
                $event->sheet->getColumnDimension('D')->setAutoSize(false);
                $event->sheet->getColumnDimension('E')->setAutoSize(false);
                $event->sheet->getColumnDimension('A')->setWidth(16);
                $event->sheet->getColumnDimension('B')->setWidth(16);
                $event->sheet->getColumnDimension('C')->setWidth(16);
                $event->sheet->getColumnDimension('D')->setWidth(16);
                $event->sheet->getColumnDimension('E')->setWidth(16);

                $event->sheet->getStyle('A6:E6')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'E8A0FF'],]);


            // Set A1:D4 range to wrap text in cells
            // $event->sheet->getDelegate()->getStyle('A1:D4')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
