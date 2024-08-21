<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Wilayah;
use App\Exports\KegiatanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
{
    $wilayah = Wilayah::select('nama_kabupaten')->distinct()->get();
    $query = Kegiatan::query();

    if ($request->has('nama_kabupaten') && $request->nama_kabupaten != '') {
        $query->whereHas('wilayah', function ($q) use ($request) {
            $q->where('nama_kabupaten', 'like', '%' . $request->nama_kabupaten . '%');
        });
    }

    if ($request->has('nama_kegiatan') && $request->nama_kegiatan != '') {
        $query->where('nama_kegiatan', 'like', '%' . $request->nama_kegiatan . '%');
    }

    $kegiatan = $query->with('wilayah')->get(); // Pastikan relasi 'wilayah' dimuat

    return view('kegiatan.index', compact('kegiatan', 'wilayah'));
}



    public function create()
    {
        $wilayah = Wilayah::all();
        return view('kegiatan.create', compact('wilayah'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_kegiatan' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'waktu' => 'required|date_format:H:i',
        'peserta_terlibat' => 'required|integer',
        'uraian_kegiatan' => 'required|string',
        'personil_terlibat' => 'required|integer',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'wilayah.nama_kabupaten' => 'required|string',
        'wilayah.nama_kecamatan' => 'nullable|string',
        'wilayah.nama_kelurahan' => 'nullable|string',
        'wilayah.rt' => 'nullable|string',
        'wilayah.rw' => 'nullable|string',
    ]);

    $fotoPath = $request->hasFile('foto') ? $request->file('foto')->store('uploads', 'public') : null;

    // Simpan data kegiatan
    $kegiatan = Kegiatan::create([
        'nama_kegiatan' => $request->input('nama_kegiatan'),
        'tanggal' => $request->input('tanggal'),
        'waktu' => $request->input('waktu'),
        'peserta_terlibat' => $request->input('peserta_terlibat'),
        'uraian_kegiatan' => $request->input('uraian_kegiatan'),
        'personil_terlibat' => $request->input('personil_terlibat'),
        'foto' => $fotoPath,
    ]);

    // Simpan data wilayah dan kaitkan dengan kegiatan
    $wilayah = Wilayah::create([
        'kegiatan_id' => $kegiatan->id,
        'nama_kabupaten' => $request->input('wilayah.nama_kabupaten'),
        'nama_kecamatan' => $request->input('wilayah.nama_kecamatan'),
        'nama_kelurahan' => $request->input('wilayah.nama_kelurahan'),
        'rt' => $request->input('wilayah.rt'),
        'rw' => $request->input('wilayah.rw'),
    ]);

    return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
}


    public function show($id)
    {
        $kegiatan = Kegiatan::with('wilayah')->findOrFail($id);
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit($id)
{
    $kegiatan = Kegiatan::with('wilayah')->findOrFail($id);
    $wilayah = Wilayah::all();
    return view('kegiatan.edit', compact('kegiatan', 'wilayah'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_kegiatan' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'waktu' => 'required|date_format:H:i',
        'peserta_terlibat' => 'required|integer',
        'uraian_kegiatan' => 'required|string',
        'personil_terlibat' => 'required|integer',
        'wilayah.nama_kabupaten' => 'required|string',
        'wilayah.nama_kecamatan' => 'nullable|string',
        'wilayah.nama_kelurahan' => 'nullable|string',
        'wilayah.rt' => 'nullable|string',
        'wilayah.rw' => 'nullable|string',
    ]);

    $kegiatan = Kegiatan::findOrFail($id);

    // Update kegiatan
    $kegiatan->update([
        'nama_kegiatan' => $request->input('nama_kegiatan'),
        'tanggal' => $request->input('tanggal'),
        'waktu' => $request->input('waktu'),
        'peserta_terlibat' => $request->input('peserta_terlibat'),
        'uraian_kegiatan' => $request->input('uraian_kegiatan'),
        'personil_terlibat' => $request->input('personil_terlibat'),
    ]);

    // Update wilayah
    $wilayahData = [
        'nama_kabupaten' => $request->input('wilayah.nama_kabupaten'),
        'nama_kecamatan' => $request->input('wilayah.nama_kecamatan'),
        'nama_kelurahan' => $request->input('wilayah.nama_kelurahan'),
        'rt' => $request->input('wilayah.rt'),
        'rw' => $request->input('wilayah.rw')
    ];

    $wilayah = Wilayah::updateOrCreate(
        ['kegiatan_id' => $kegiatan->id],
        $wilayahData
    );

    return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
}


    public function destroy($id)
    {
         $kegiatan = Kegiatan::findOrFail($id);
        if ($kegiatan->foto && file_exists(public_path('storage/'.$kegiatan->foto))) {
            unlink(public_path('storage/'.$kegiatan->foto));
        }
        $kegiatan->wilayah()->delete();
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
    public function bantul()
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
            
                ->get();
        }

        return view('kegiatan.bantul', ['kegiatanData' => $kegiatanData]);
    }
        public function gk()
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
                    $query->where('nama_kabupaten', 'Kabupaten Gunung Kidul');
                })
            
                ->get();
        }

        return view('kegiatan.gk', ['kegiatanData' => $kegiatanData]);
    }
    public function kota()
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
                    $query->where('nama_kabupaten', 'Kotamadya Yogyakarta');
                })
            
                ->get();
        }

        return view('kegiatan.kota', ['kegiatanData' => $kegiatanData]);
    }
    public function kp()
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
                    $query->where('nama_kabupaten', 'Kabupaten Kulon Progo');
                })
            
                ->get();
        }

        return view('kegiatan.kp', ['kegiatanData' => $kegiatanData]);
    }
        public function sleman()
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
                $query->where('nama_kabupaten', 'Kabupaten Sleman');
            })
            ->get();
    }

    return view('kegiatan.sleman', compact('kegiatanData'));
}
    
    public function export()
{
    $kegiatan = Kegiatan::with('wilayah')->get();

    return Excel::download(new KegiatanExport($kegiatan), 'kegiatan.xlsx');
}

    
}
