<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Daftar nama kegiatan dari array
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

        // Mengambil semua data kegiatan dari database
        $kegiatan = Kegiatan::all();

        // Menghitung total kegiatan berdasarkan nama kegiatan dari database
        $dampakKegiatan = collect($namaBencana)->map(function ($nama_kegiatan) use ($kegiatan) {
            $total = $kegiatan->where('nama_kegiatan', $nama_kegiatan)->count();
            return (object) [
                'nama_kegiatan' => $nama_kegiatan,
                'total' => $total,
            ];
        });

        // Daftar nama kabupaten
        $namaKabupaten = [
            'Kotamadya Yogyakarta',
            'Kabupaten Sleman',
            'Kabupaten Gunung Kidul',
            'Kabupaten Kulon Progo',
            'Kabupaten Bantul'
        ];

        // Mengambil semua data kabupaten dari database
        $wilayah = Wilayah::all();

        // Menghitung total kegiatan berdasarkan nama kabupaten dari database
        $kabupatenKegiatan = collect($namaKabupaten)->map(function ($nama_kabupaten) use ($wilayah) {
            $total = $wilayah->where('nama_kabupaten', $nama_kabupaten)->count();
            return (object) [
                'nama_kabupaten' => $nama_kabupaten,
                'total' => $total,
            ];
        });

        // Total semua kegiatan
        $kegiatanTotal = $kegiatan->count();
        // Total semua kabupaten
        $kabupatenTotal = $wilayah->count();

        // Mendapatkan data kegiatan per bulan
        $monthlyData = Kegiatan::selectRaw('MONTH(tanggal) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Array untuk menyimpan total kegiatan per bulan
        $monthlyTotals = array_fill(1, 12, 0);

        // Mengisi array dengan data yang diperoleh dari database
        foreach ($monthlyData as $data) {
            $monthlyTotals[$data->month] = $data->total;
        }

        // Mengubah format data untuk labels (nama bulan)
        $labels = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Mengambil nilai total untuk grafik
        $data = array_values($monthlyTotals);

        $labels2 = $kabupatenKegiatan->pluck('nama_kabupaten')->toArray();
        $data2 = $kabupatenKegiatan->pluck('total')->toArray();

        return view('dashboard', compact(
            'kegiatanTotal', 
            'kabupatenTotal', 
            'dampakKegiatan',  
            'kabupatenKegiatan', 
            'labels', 
            'data', 
            'labels2', 
            'data2'
        ));
    }
}
