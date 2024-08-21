@extends('adminlte1::page')

@section('title', 'Edit Kegiatan')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Edit Kegiatan</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('petugas.update', $kegiatan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan:</label>
                    <select name="nama_kegiatan" id="nama_kegiatan" class="form-control @error('nama_kegiatan') is-invalid @enderror" required>
                        <option value="">-- Pilih Nama Kegiatan --</option>
                        <option value="Tagana Masuk Sekolah" {{ old('nama_kegiatan', $kegiatan->nama_kegiatan) == 'Tagana Masuk Sekolah' ? 'selected' : '' }}>Tagana Masuk Sekolah</option>
                        <option value="Tagana Masuk Komunitas" {{ old('nama_kegiatan', $kegiatan->nama_kegiatan) == 'Tagana Masuk Komunitas' ? 'selected' : '' }}>Tagana Masuk Komunitas</option>
                        <option value="Pembentukan Kampung Siaga Bencana" {{ old('nama_kegiatan', $kegiatan->nama_kegiatan) == 'Pembentukan Kampung Siaga Bencana' ? 'selected' : '' }}>Pembentukan Kampung Siaga Bencana</option>
                        <option value="Penyaluran/Droping Logistik" {{ old('nama_kegiatan', $kegiatan->nama_kegiatan) == 'Penyaluran/Droping Logistik' ? 'selected' : '' }}>Penyaluran/Droping Logistik</option>
                        <option value="Mitigasi Bencana" {{ old('nama_kegiatan', $kegiatan->nama_kegiatan) == 'Mitigasi Bencana' ? 'selected' : '' }}>Mitigasi Bencana</option>
                        <option value="Peningkatan Kapasitas" {{ old('nama_kegiatan', $kegiatan->nama_kegiatan) == 'Peningkatan Kapasitas' ? 'selected' : '' }}>Peningkatan Kapasitas</option>
                        <option value="Kegiatan Sertifikasi" {{ old('nama_kegiatan', $kegiatan->nama_kegiatan) == 'Kegiatan Sertifikasi' ? 'selected' : '' }}>Kegiatan Sertifikasi</option>
                        <option value="Penyelenggaraan Dapur Umum" {{ old('nama_kegiatan', $kegiatan->nama_kegiatan) == 'Penyelenggaraan Dapur Umum' ? 'selected' : '' }}>Penyelenggaraan Dapur Umum</option>
                        <option value="Penyaluran/Droping Logistik KSB" {{ old('nama_kegiatan', $kegiatan->nama_kegiatan) == 'Penyaluran/Droping Logistik KSB' ? 'selected' : '' }}>Penyaluran/Droping Logistik KSB</option>
                    </select>
                    @error('nama_kegiatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal" class="font-weight-bold">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="waktu" class="font-weight-bold">Waktu</label>
                        <input type="time" class="form-control" id="waktu" name="waktu" value="{{ old('waktu', $kegiatan->waktu) }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="peserta_terlibat" class="font-weight-bold">Peserta Terlibat</label>
                    <input type="text" class="form-control" id="peserta_terlibat" name="peserta_terlibat" value="{{ old('peserta_terlibat', $kegiatan->peserta_terlibat) }}" required>
                </div>
                <div class="form-group">
                    <label for="uraian_kegiatan" class="font-weight-bold">Uraian Kegiatan</label>
                    <textarea class="form-control" id="uraian_kegiatan" name="uraian_kegiatan" rows="3" required>{{ old('uraian_kegiatan', $kegiatan->uraian_kegiatan) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="personil_terlibat" class="font-weight-bold">Personil Terlibat</label>
                    <input type="text" class="form-control" id="personil_terlibat" name="personil_terlibat" value="{{ old('personil_terlibat', $kegiatan->personil_terlibat) }}" required>
                </div>
                <hr>
                <h5 class="font-weight-bold mb-3">Wilayah Terkait</h5>
                <div id="wilayah-input">
                    @if($kegiatan->wilayah && $kegiatan->wilayah->isNotEmpty())
                        @php $wilayah = $kegiatan->wilayah->first(); @endphp
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_kabupaten" class="font-weight-bold">Nama Kabupaten</label>
                                    <select class="form-control" id="nama_kabupaten" name="wilayah[nama_kabupaten]" required>
                                        <option value="Kotamadya Yogyakarta" {{ $wilayah->nama_kabupaten == 'Kotamadya Yogyakarta' ? 'selected' : '' }}>Kotamadya Yogyakarta</option>
                                        <option value="Kabupaten Sleman" {{ $wilayah->nama_kabupaten == 'Kabupaten Sleman' ? 'selected' : '' }}>Kabupaten Sleman</option>
                                        <option value="Kabupaten Gunung Kidul" {{ $wilayah->nama_kabupaten == 'Kabupaten Gunung Kidul' ? 'selected' : '' }}>Kabupaten Gunung Kidul</option>
                                        <option value="Kabupaten Kulon Progo" {{ $wilayah->nama_kabupaten == 'Kabupaten Kulon Progo' ? 'selected' : '' }}>Kabupaten Kulon Progo</option>
                                        <option value="Kabupaten Bantul" {{ $wilayah->nama_kabupaten == 'Kabupaten Bantul' ? 'selected' : '' }}>Kabupaten Bantul</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_kecamatan" class="font-weight-bold">Nama Kecamatan</label>
                                    <input type="text" class="form-control" id="nama_kecamatan" name="wilayah[nama_kecamatan]" value="{{ old('wilayah[nama_kecamatan]', $wilayah->nama_kecamatan) }}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_kelurahan" class="font-weight-bold">Nama Kelurahan</label>
                                    <input type="text" class="form-control" id="nama_kelurahan" name="wilayah[nama_kelurahan]" value="{{ old('wilayah[nama_kelurahan]', $wilayah->nama_kelurahan) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="rt" class="font-weight-bold">RT</label>
                                    <input type="text" class="form-control" id="rt" name="wilayah[rt]" value="{{ old('wilayah[rt]', $wilayah->rt) }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="rw" class="font-weight-bold">RW</label>
                                    <input type="text" class="form-control" id="rw" name="wilayah[rw]" value="{{ old('wilayah[rw]', $wilayah->rw) }}">
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_kabupaten" class="font-weight-bold">Nama Kabupaten</label>
                                    <input type="text" class="form-control" id="nama_kabupaten" name="wilayah[nama_kabupaten]" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_kecamatan" class="font-weight-bold">Nama Kecamatan</label>
                                    <input type="text" class="form-control" id="nama_kecamatan" name="wilayah[nama_kecamatan]" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_kalurahan" class="font-weight-bold">Nama Kalurahan</label>
                                    <input type="text" class="form-control" id="nama_kalurahan" name="wilayah[nama_kalurahan]" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="rt" class="font-weight-bold">RT</label>
                                        <input type="text" class="form-control" id="rt" name="wilayah[rt]">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="rw" class="font-weight-bold">RW</label>
                                        <input type="text" class="form-control" id="rw" name="wilayah[rw]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <hr>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
