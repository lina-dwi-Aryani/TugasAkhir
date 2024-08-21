<?php

namespace App\Http\Controllers;

use App\Exports\BantulExport;
use App\Exports\KotaExport;
use App\Exports\SlemanExport;
use App\Exports\KPExport;
use App\Exports\GkExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kegiatan;

class ExportController extends Controller
{
    public function exportBantul(Request $request)
    {
        $kegiatanNames = [
            'Tagana Masuk Sekolah',
            'Tagana Masuk Komunitas',
            'Pembentukan Kampung Siaga Bencana',
            'Penyaluran/Droping Logistik',
            'Mitigasi Bencana',
            'Peningkatan Kapasitas',
            'Kegiatan Sertifikasi',
            'Penyelenggaraan Dapur Umum',
            'Penyaluran/Droping Logistik KSB'
        ];

        $kegiatanData = [];

        foreach ($kegiatanNames as $namaKegiatan) {
            $kegiatanData[] = Kegiatan::where('nama_kegiatan', $namaKegiatan)
                ->whereHas('wilayah', function ($query) {
                    $query->where('nama_kabupaten', 'Kabupaten Bantul');
                })
                ->with('wilayah')
                ->get();
        }

        $export = new BantulExport($kegiatanData, $kegiatanNames);

        return Excel::download($export, 'Rekap Data Kegiatan Bantul 2024.xlsx');
    }
    public function exportSleman(Request $request)
    {
        $kegiatanNames = [
            'Tagana Masuk Sekolah',
            'Tagana Masuk Komunitas',
            'Pembentukan Kampung Siaga Bencana',
            'Penyaluran/Droping Logistik',
            'Mitigasi Bencana',
            'Peningkatan Kapasitas',
            'Kegiatan Sertifikasi',
            'Penyelenggaraan Dapur Umum',
            'Penyaluran/Droping Logistik KSB'
        ];

        $kegiatanData = [];

        foreach ($kegiatanNames as $namaKegiatan) {
            $kegiatanData[] = Kegiatan::where('nama_kegiatan', $namaKegiatan)
                ->whereHas('wilayah', function ($query) {
                    $query->where('nama_kabupaten', 'Kabupaten Sleman');
                })
                ->with('wilayah')
                ->get();
        }

        $export = new SlemanExport($kegiatanData, $kegiatanNames);

        return Excel::download($export, 'Rekap Data Kegiatan Sleman 2024.xlsx');
    }
    public function exportKota(Request $request)
    {
        $kegiatanNames = [
            'Tagana Masuk Sekolah',
            'Tagana Masuk Komunitas',
            'Pembentukan Kampung Siaga Bencana',
            'Penyaluran/Droping Logistik',
            'Mitigasi Bencana',
            'Peningkatan Kapasitas',
            'Kegiatan Sertifikasi',
            'Penyelenggaraan Dapur Umum',
            'Penyaluran/Droping Logistik KSB'
        ];

        $kegiatanData = [];

        foreach ($kegiatanNames as $namaKegiatan) {
            $kegiatanData[] = Kegiatan::where('nama_kegiatan', $namaKegiatan)
                ->whereHas('wilayah', function ($query) {
                    $query->where('nama_kabupaten', 'Kotamadya Yogyakarta');
                })
                ->with('wilayah')
                ->get();
        }

        $export = new KotaExport($kegiatanData, $kegiatanNames);

        return Excel::download($export, 'Rekap Data Kegiatan Kotamadya Yogyakarta 2024.xlsx');
    }

    public function exportKP(Request $request)
    {
        $kegiatanNames = [
            'Tagana Masuk Sekolah',
            'Tagana Masuk Komunitas',
            'Pembentukan Kampung Siaga Bencana',
            'Penyaluran/Droping Logistik',
            'Mitigasi Bencana',
            'Peningkatan Kapasitas',
            'Kegiatan Sertifikasi',
            'Penyelenggaraan Dapur Umum',
            'Penyaluran/Droping Logistik KSB'
        ];

        $kegiatanData = [];

        foreach ($kegiatanNames as $namaKegiatan) {
            $kegiatanData[] = Kegiatan::where('nama_kegiatan', $namaKegiatan)
                ->whereHas('wilayah', function ($query) {
                    $query->where('nama_kabupaten', 'Kabupaten Kulon Progo');
                })
                ->with('wilayah')
                ->get();
        }

        $export = new KPExport($kegiatanData, $kegiatanNames);

        return Excel::download($export, 'Rekap Data Kegiatan Kulon Progo 2024.xlsx');   
     }
     public function exportGK(Request $request)
     {
         $kegiatanNames = [
             'Tagana Masuk Sekolah',
             'Tagana Masuk Komunitas',
             'Pembentukan Kampung Siaga Bencana',
             'Penyaluran/Droping Logistik',
             'Mitigasi Bencana',
             'Peningkatan Kapasitas',
             'Kegiatan Sertifikasi',
             'Penyelenggaraan Dapur Umum',
             'Penyaluran/Droping Logistik KSB'
         ];
 
         $kegiatanData = [];
 
         foreach ($kegiatanNames as $namaKegiatan) {
             $kegiatanData[] = Kegiatan::where('nama_kegiatan', $namaKegiatan)
                 ->whereHas('wilayah', function ($query) {
                     $query->where('nama_kabupaten', 'Kabupaten Gunung Kidul');
                 })
                 ->with('wilayah')
                 ->get();
         }
 
         $export = new GkExport($kegiatanData, $kegiatanNames);
 
         return Excel::download($export, 'Rekap Data Kegiatan GunungKidul 2024.xlsx');   
      }
    public function index()
    {
        $kegiatanNames = [
            'Tagana Masuk Sekolah',
            'Tagana Masuk Komunitas',
            'Pembentukan Kampung Siaga Bencana',
            'Penyaluran/Droping Logistik',
            'Mitigasi Bencana',
            'Peningkatan Kapasitas',
            'Kegiatan Sertifikasi',
            'Penyelenggaraan Dapur Umum',
            'Penyaluran/Droping Logistik KSB'
        ];

        $kegiatanData = [];

        foreach ($kegiatanNames as $namaKegiatan) {
            $kegiatanData[str_replace(' ', '', lcfirst($namaKegiatan))] = Kegiatan::where('nama_kegiatan', $namaKegiatan)
                ->whereHas('wilayah', function ($query) {
                    $query->where('nama_kabupaten', 'Kabupaten Bantul');
                })
                ->with('wilayah')
                ->get();
        }

        return view('export.bantul', $kegiatanData);
    }
}
