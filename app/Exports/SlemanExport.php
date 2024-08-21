<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

class SlemanExport implements FromCollection, WithEvents
{
    protected $data;
    protected $request;
    protected $groupTitleRows = [];
    protected $headingRows = [];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA KEGIATAN',
            'TANGGAL',
            'WAKTU',
            'Nama Kabupaten',
            'Nama KALURAHAN',
            'Nama Kecamatan',
            'RW',
            'RT',
            'PESERTA TERLIBAT',
            'URAIAN KEGIATAN',
            'PERSONIL TERLIBAT',
        ];
    }

    public function collection()
    {
        $data = [];
        $currentRow = 1;

        $kelompokKegiatan = [
            ['Tagana Masuk Sekolah', Kegiatan::where('nama_kegiatan', 'Tagana Masuk Sekolah')->whereHas('wilayah', function ($query) {
                $query->where('nama_kabupaten', 'Kabupaten Sleman');
            })->with('wilayah')->get()],
            ['Tagana Masuk Komunitas', Kegiatan::where('nama_kegiatan', 'Tagana Masuk Komunitas')->whereHas('wilayah', function ($query) {
                $query->where('nama_kabupaten', 'Kabupaten Sleman');
            })->with('wilayah')->get()],
            ['Pembentukan Kampung Siaga Bencana', Kegiatan::where('nama_kegiatan', 'Pembentukan Kampung Siaga Bencana')->whereHas('wilayah', function ($query) {
                $query->where('nama_kabupaten', 'Kabupaten Sleman');
            })->with('wilayah')->get()],
            ['Penyaluran / Droping Logistik', Kegiatan::where('nama_kegiatan', 'Penyaluran / Droping Logistik')->whereHas('wilayah', function ($query) {
                $query->where('nama_kabupaten', 'Kabupaten Sleman');
            })->with('wilayah')->get()],
            ['Mitigasi Bencana', Kegiatan::where('nama_kegiatan', 'Mitigasi Bencana')->whereHas('wilayah', function ($query) {
                $query->where('nama_kabupaten', 'Kabupaten Sleman');
            })->with('wilayah')->get()],
            ['Peningkatan Kapasitas', Kegiatan::where('nama_kegiatan', 'Peningkatan Kapasitas')->whereHas('wilayah', function ($query) {
                $query->where('nama_kabupaten', 'Kabupaten Sleman');
            })->with('wilayah')->get()],
            ['Kegiatan Sertifikasi', Kegiatan::where('nama_kegiatan', 'Kegiatan Sertifikasi')->whereHas('wilayah', function ($query) {
                $query->where('nama_kabupaten', 'Kabupaten Sleman');
            })->with('wilayah')->get()],
            ['Penyaluran Dapur Umum', Kegiatan::where('nama_kegiatan', 'Penyaluran Dapur Umum')->whereHas('wilayah', function ($query) {
                $query->where('nama_kabupaten', 'Kabupaten Sleman');
            })->with('wilayah')->get()],
            ['Penyaluran / Droping Logistik KSB', Kegiatan::where('nama_kegiatan', 'Penyaluran / Droping Logistik KSB')->whereHas('wilayah', function ($query) {
                $query->where('nama_kabupaten', 'Kabupaten Sleman');
            })->with('wilayah')->get()],
        ];

        // Add main title
        $data[] = ['REKAP DATA KEGIATAN KABUPATEN SLEMAN'];
        $currentRow++;
        $data[] = [];
        $currentRow++;

        foreach ($kelompokKegiatan as $kelompok) {
            // Add the group title
            $data[] = [$kelompok[0]];
            $this->groupTitleRows[] = $currentRow;
            $currentRow++;

            $data[] = [];
            $currentRow++;

            // Add the headings
            $data[] = $this->headings();
            $this->headingRows[] = $currentRow;
            $currentRow++;

            // Add the data rows
            foreach ($kelompok[1] as $key => $kegiatan) {
                $data[] = [
                    $key + 1,
                    $kegiatan->nama_kegiatan,
                    $kegiatan->tanggal,
                    $kegiatan->waktu,
                    $kegiatan->wilayah->first()->nama_kabupaten,
                    $kegiatan->wilayah->first()->nama_kalurahan,
                    $kegiatan->wilayah->first()->nama_kecamatan,
                    $kegiatan->wilayah->first()->rw,
                    $kegiatan->wilayah->first()->rt,
                    $kegiatan->peserta_terlibat,
                    $kegiatan->uraian_kegiatan,
                    $kegiatan->personil_terlibat,
                ];
                $currentRow++;
            }

            // Add an empty row after each group
            $data[] = [''];
            $currentRow++;
        }

        // Jika ada inputan user, maka tambahkan data ke dalam array
        if (isset($this->request['inputan_user'])) {
            $inputanUser = $this->request['inputan_user'];
            $data[] = ['INPUTAN USER'];
            $this->groupTitleRows[] = $currentRow;
            $currentRow++;
            $data[] = [];
            $currentRow++;
            $data[] = ['NO', 'NAMA KEGIATAN', 'TANGGAL', 'WAKTU', 'Nama Kabupaten', 'Nama KALURAHAN', 'Nama Kecamatan', 'RW', 'RT', 'PESERTA TERLIBAT', 'URAIAN KEGIATAN', 'PERSONIL TERLIBAT'];
            $this->headingRows[] = $currentRow;
            $currentRow++;

            foreach ($inputanUser as $key => $value) {
                $data[] = [
                    $key + 1,
                    $value['nama_kegiatan'],
                    $value['tanggal'],
                    $value['waktu'],
                    $value['nama_kabupaten'],
                    $value['nama_kalurahan'],
                    $value['nama_kecamatan'],
                    $value['rw'],
                    $value['rt'],
                    $value['peserta_terlibat'],
                    $value['uraian_kegiatan'],
                    $value['personil_terlibat'],
                ];
                $currentRow++;
            }
        }

        $this->data = collect($data);

        return $this->data;
    }

    public function registerEvents(): array
{
    return [
        AfterSheet::class => function (AfterSheet $event) {
            $sheet = $event->sheet->getDelegate();
    
            // Merge sel untuk judul utama
            $sheet->mergeCells('A1:H1');
            $sheet->setCellValue('A1', 'REKAP DATA KEGIATAN KABUPATEN SLEMAN');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
            // Array untuk warna setiap judul kelompok kegiatan
            $groupTitleColors = [
                'Tagana Masuk Sekolah' => 'E6E6FA', // Warna untuk Tagana Masuk Sekolah
                'Tagana Masuk Komunitas' => '00FF7F', // Warna untuk Tagana Masuk Komunitas
                'Pembentukan Kampung Siaga Bencana' => '00FFFF', // Warna untuk Pembentukan Kampung Siaga Bencana
                'Penyaluran / Droping Logistik' => '00FF00',
                'Mitigasi Bencana' => '32CD32',
                'Peningkatan Kapasitas' => '87CEEB',
                'Kegiatan Sertifikasi' => 'C0C0C0',
                'Penyaluran Dapur Umum' => '40E0D0',
                'Penyaluran / Droping Logistik KSB' => '7FFF00',
                // Tambahkan warna lainnya untuk setiap judul kelompok kegiatan
            ];
    
            // Looping untuk setiap judul kelompok kegiatan
            foreach ($groupTitleColors as $title => $color) {
                // Tambahkan judul kelompok ke data
                $data[] = [$title];
                // Tambahkan heading setelah judul
                $data[] = $this->headings();
                // Menambahkan baris kosong setelah header
                $data[] = [''];
    
                // Cari baris yang memiliki judul kelompok kegiatan yang sesuai
                $row = 1; // Default baris pertama jika tidak ditemukan
                foreach ($sheet->getRowIterator() as $rowIndex => $rowObj) {
                    if ($rowObj->getCellIterator()->current()->getValue() === $title) {
                        $row = $rowIndex;
                        break;
                    }
                }
                // Set column widths and row heights
                $columnWidths = [5, 30, 10, 10, 20, 20, 20, 4,4,20,30,20];
                foreach (range('A', 'L') as $index => $column) {
                    $sheet->getColumnDimension($column)->setWidth($columnWidths[$index]);
                }
                            // Mendapatkan kolom yang akan diwarnai
                $highestColumn = $sheet->getHighestColumn();
                $columnRange = 'A' . $row . ':' . $highestColumn . $row;
    
                // Memberikan warna pada judul kelompok kegiatan yang sesuai
                $sheet->getStyle($columnRange)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => $color],
                    ],
                ]);
            }
    
            // Set judul sheet
            $event->sheet->setTitle('SLEMAN');
        },
    ];
}
}