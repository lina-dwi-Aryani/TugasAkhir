<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Wilayah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetugasController extends Controller
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

    return view('petugas.index', compact('kegiatan', 'wilayah'));
}



    public function create()
    {
        $wilayah = Wilayah::all();
        return view('petugas.create', compact('wilayah'));
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

    return redirect()->route('petugas.index')->with('success', 'Kegiatan berhasil ditambahkan.');
}


    public function show($id)
    {
        $kegiatan = Kegiatan::with('wilayah')->findOrFail($id);
        return view('petugas.show', compact('kegiatan'));
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::with('wilayah')->findOrFail($id);
        $wilayah = Wilayah::all();
        return view('petugas.edit', compact('kegiatan', 'wilayah'));
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
    $wilayah = Wilayah::updateOrCreate(
        ['kegiatan_id' => $kegiatan->id],
        $request->only([
            'wilayah.nama_kabupaten',
            'wilayah.nama_kecamatan',
            'wilayah.nama_kelurahan',
            'wilayah.rt',
            'wilayah.rw'
        ])
    );

    return redirect()->route('petugas.index')->with('success', 'Kegiatan berhasil diperbarui.');
}


    public function destroy($id)
    {
         $kegiatan = Kegiatan::findOrFail($id);
        if ($kegiatan->foto && file_exists(public_path('storage/'.$kegiatan->foto))) {
            unlink(public_path('storage/'.$kegiatan->foto));
        }
        $kegiatan->wilayah()->delete();
        $kegiatan->delete();

        return redirect()->route('petugas.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
    
}
