<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class KegiatanExport implements FromCollection, WithHeadings, WithEvents
{
    private $data;

    public function collection()
    {
        $namaBencana = [
            'Tagana Masuk Sekolah',
            'Tagana Masuk Komunitas',
            'Pembentukan Kampung Siaga Bencana',
            'Penyaluran/Droping Logistik',
            'Mitigasi Bencana',
            'Peningkatan Kapasitas',
            'Kegiatan Sertifikasi',
            'Penyelenggaraan Dapur Umum',
            'Penyaluran/Droping Logistik KSB',
        ];

        $data = [];
        $monthlyData = [];
        $totalByKabupaten = [
            'Kotamadya Yogyakarta' => 0,
            'Kabupaten Bantul' => 0,
            'Kabupaten Kulon Progo' => 0,
            'Kabupaten Gunungkidul' => 0,
            'Kabupaten Sleman' => 0,
        ];

        // Data Kelompok Kegiatan
        foreach ($namaBencana as $key => $bencana) {
            $row = [];
            $row['NO'] = $key + 1;
            $row['NAMA KEGIATAN'] = $bencana;

            $total = 0;
            foreach ($totalByKabupaten as $kabupaten => &$totalValue) {
                $dataPerKabupaten = Kegiatan::whereHas('wilayah', function ($query) use ($kabupaten) {
                    $query->where('nama_kabupaten', $kabupaten);
                })->where('nama_kegiatan', $bencana)->get();
                
                $sum = $dataPerKabupaten->count();
                $row[$kabupaten] = $sum;
                $totalValue += $sum;
                $total += $sum;            
            }

            $row['JUMLAH'] = $total;
            $data[] = $row;

            // Data Bulanan
            $monthlyRow = [];
            $monthlyRow['NO'] = $key + 1;
            $monthlyRow['NAMA KEGIATAN'] = $bencana;

            $totalByMonth = [];
            for ($month = 1; $month <= 12; $month++) {
                $monthlyTotal = Kegiatan::whereMonth('tanggal', $month)
                    ->where('nama_kegiatan', $bencana)
                    ->count();

                $monthlyRow[$this->monthName($month)] = $monthlyTotal;
                $totalByMonth[$month] = $monthlyTotal;
            }

            $monthlyRow['JUMLAH BULANAN'] = array_sum($totalByMonth);
            $monthlyData[] = $monthlyRow;
        }

        // Tambahkan baris total bulanan
        $monthlyTotalRow = ['NO' => '', 'NAMA KEGIATAN' => 'TOTAL BULANAN'];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyTotal = array_sum(array_column($monthlyData, $this->monthName($month)));
            $monthlyTotalRow[$this->monthName($month)] = $monthlyTotal;
        }
        $monthlyTotalRow['JUMLAH BULANAN'] = array_sum(array_column($monthlyData, 'JUMLAH BULANAN'));
        $monthlyData[] = $monthlyTotalRow;

        $data[] = [
            'NO' => '',
            'NAMA KEGIATAN' => 'TOTAL',
            'Kotamadya Yogyakarta' => $totalByKabupaten['Kotamadya Yogyakarta'],
            'Kabupaten Bantul' => $totalByKabupaten['Kabupaten Bantul'],
            'Kabupaten Kulon Progo' => $totalByKabupaten['Kabupaten Kulon Progo'],
            'Kabupaten Gunungkidul' => $totalByKabupaten['Kabupaten Gunungkidul'],
            'Kabupaten Sleman' => $totalByKabupaten['Kabupaten Sleman'],
            'JUMLAH' => array_sum($totalByKabupaten),
        ];

        // Judul untuk data harian
        $titleRowDaily = ['DATA KELOMPOK KEGIATAN'];

        // Data harian dan bulanan
        $data = collect([$titleRowDaily, $this->headings()])
            ->merge($data);

        // Tambahkan dua baris kosong sebelum data bulanan
        $data[] = []; // Baris kosong
        $data[] = []; // Baris kosong

        $monthlyData = collect([$this->monthlyHeadings()])
            ->merge($monthlyData);

        // Gabungkan data harian dan bulanan
        $mergedData = $data->merge($monthlyData);

        // Set data ke variabel
        $this->data = collect($mergedData);

        return $this->data;
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA KEGIATAN',
            'Kotamadya Yogyakarta',
            'Kabupaten Bantul',
            'Kabupaten Kulon Progo',
            'Kabupaten Gunungkidul',
            'Kabupaten Sleman',
            'JUMLAH',
        ];
    }

    public function monthlyHeadings(): array
    {
        return [
            'NO',
            'NAMA KEGIATAN',
            'JANUARI',
            'FEBRUARI',
            'MARET',
            'APRIL',
            'MEI',
            'JUNI',
            'JULI',
            'AGUSTUS',
            'SEPTEMBER',
            'OKTOBER',
            'NOVEMBER',
            'DESEMBER',
            'JUMLAH BULANAN',
        ];
    }

    public function monthName(int $month): string
    {
        return date('F', mktime(0, 0, 0, $month, 1));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Title for data
                $this->setTitle($sheet, 'A1', 'DATA AKUMULASI JANUARI S/D DESEMBER 2024', 14);
                $sheet->mergeCells('A1:O1');

                // Apply bold and center alignment to main heading rows
                $this->setStyle($sheet, 'A2:O2', [
                    'bold' => true,
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '39FF14']],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000']
                        ]
                    ]
                ]);

                // Apply bold and center alignment to heading rows for perbulan
                $lastRow = $sheet->getHighestRow() + 2; // Position after two blank rows
                $this->setStyle($sheet, 'A' . $lastRow . ':O' . $lastRow, [
                    'bold' => true,
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '39FF14']],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000']
                        ]
                    ]
                ]);

                // Apply borders to the whole sheet
                $this->setStyle($sheet, 'A2:O' . $sheet->getHighestRow(), [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000']
                        ]
                    ]
                ]);

                // Set column widths
                $this->setColumnWidths($sheet, [
                    'A' => 5,
                    'B' => 34,
                    'C' => 15,
                    'D' => 15,
                    'E' => 15,
                    'F' => 15,
                    'G' => 15,
                    'H' => 15,
                    'I' => 15,
                    'J' => 15,
                    'K' => 15,
                    'L' => 15,
                    'M' => 15,
                    'N' => 15,
                    'O' => 25,
                ]);

                // Title for sheet
                $event->sheet->setTitle('Rekap Total');
            },
        ];
    }

    private function setTitle($sheet, $cell, $title, $size)
    {
        $sheet->setCellValue($cell, $title);
        $sheet->getStyle($cell)->getFont()->setBold(true)->setSize($size);
        $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    private function setStyle($sheet, $cell, $style)
    {
        $sheet->getStyle($cell)->applyFromArray($style);
    }

    private function setColumnWidths($sheet, $widths)
    {
        foreach ($widths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }
    }
}
