@extends('adminlte1::page')

@section('title', 'Tambah Kegiatan')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Tambah Kegiatan</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan:</label>
                    <select name="nama_kegiatan" id="nama_kegiatan" class="form-control @error('nama_kegiatan') is-invalid @enderror" required>
                        <option value="">-- Pilih Nama Kegiatan --</option>
                        <option value="Tagana Masuk Sekolah" {{ old('nama_kegiatan') == 'Tagana Masuk Sekolah' ? 'selected' : '' }}>Tagana Masuk Sekolah</option>
                        <option value="Tagana Masuk Komunitas" {{ old('nama_kegiatan') == 'Tagana Masuk Komunitas' ? 'selected' : '' }}>Tagana Masuk Komunitas</option>
                        <option value="Pembentukan Kampung Siaga Bencana" {{ old('nama_kegiatan') == 'Pembentukan Kampung Siaga Bencana' ? 'selected' : '' }}>Pembentukan Kampung Siaga Bencana</option>
                        <option value="Penyaluran/Droping Logistik" {{ old('nama_kegiatan') == 'Penyaluran/Droping Logistik' ? 'selected' : '' }}>Penyaluran/Droping Logistik</option>
                        <option value="Mitigasi Bencana" {{ old('nama_kegiatan') == 'Mitigasi Bencana' ? 'selected' : '' }}>Mitigasi Bencana</option>
                        <option value="Peningkatan Kapasitas" {{ old('nama_kegiatan') == 'Peningkatan Kapasitas' ? 'selected' : '' }}>Peningkatan Kapasitas</option>
                        <option value="Kegiatan Sertifikasi" {{ old('nama_kegiatan') == 'Kegiatan Sertifikasi' ? 'selected' : '' }}>Kegiatan Sertifikasi</option>
                        <option value="Penyelenggaraan Dapur Umum" {{ old('nama_kegiatan') == 'Penyelenggaraan Dapur Umum' ? 'selected' : '' }}>Penyelenggaraan Dapur Umum</option>
                        <option value="Penyaluran/Droping Logistik KSB" {{ old('nama_kegiatan') == 'Penyaluran/Droping Logistik KSB' ? 'selected' : '' }}>Penyaluran/Droping Logistik KSB</option>
                        <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                    </select>
                    @error('nama_kegiatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="waktu">Waktu</label>
                        <input type="time" class="form-control" id="waktu" name="waktu" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="peserta_terlibat">Peserta Terlibat</label>
                    <input type="text" class="form-control" id="peserta_terlibat" name="peserta_terlibat" required>
                </div>
                <div class="form-group">
                    <label for="uraian_kegiatan">Uraian Kegiatan</label>
                    <textarea class="form-control" id="uraian_kegiatan" name="uraian_kegiatan" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="personil_terlibat">Personil Terlibat</label>
                    <input type="text" class="form-control" id="personil_terlibat" name="personil_terlibat" required>
                </div>
                <div class="form-group">
                    <label for="foto">Foto Kegiatan:</label>
                    <input type="file" id="foto" name="foto" class="form-control @error('foto') is-invalid @enderror">
                    @error('foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <hr>
                <div id="wilayah-inputs">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-row">
                                <label for="nama_kabupaten">Nama Kabupaten</label>
                                    <select class="form-control" id="nama_kabupaten" name="wilayah[nama_kabupaten]" required>
                                        <option value="">-- Pilih Nama Kabupaten --</option>
                                        <option value="Kotamadya Yogyakarta">Kotamadya Yogyakarta</option>
                                        <option value="Kabupaten Sleman">Kabupaten Sleman</option>
                                        <option value="Kabupaten Gunung Kidul">Kabupaten Gunung Kidul</option>
                                        <option value="Kabupaten Kulon Progo">Kabupaten Kulon Progo</option>
                                        <option value="Kabupaten Bantul">Kabupaten Bantul</option>
                                        <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_kecamatan">Nama Kecamatan</label>
                                    <input type="text" class="form-control" id="nama_kecamatan" name="wilayah[nama_kecamatan]">
                                </div>
                                <div class="form-group">
                                    <label for="nama_kelurahan">Nama Kelurahan</label>
                                    <input type="text" class="form-control" id="nama_kelurahan" name="wilayah[nama_kelurahan]">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="rt">RT</label>
                                    <input type="text" class="form-control" id="rt" name="wilayah[rt]">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="rw">RW</label>
                                    <input type="text" class="form-control" id="rw" name="wilayah[rw]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
