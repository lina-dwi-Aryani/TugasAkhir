@extends('adminlte1::page')

@section('title', 'Daftar Kegiatan')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <h2 class="mb-0">Daftar Kegiatan</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="mb-3">
                <form action="{{ route('petugas.index') }}" method="GET" class="form-inline">
                    <div class="form-group mr-2">
                        <select class="form-control" id="nama_kabupaten" name="nama_kabupaten">
                            <option value="">Semua Kabupaten</option>
                            <option value="Kotamadya Yogyakarta" {{ request('nama_kabupaten') == 'Kotamadya Yogyakarta' ? 'selected' : '' }}>Kotamadya Yogyakarta</option>
                            <option value="Kabupaten Sleman" {{ request('nama_kabupaten') == 'Kabupaten Sleman' ? 'selected' : '' }}>Kabupaten Sleman</option>
                            <option value="Kabupaten Gunung Kidul" {{ request('nama_kabupaten') == 'Kabupaten Gunung Kidul' ? 'selected' : '' }}>Kabupaten Gunung Kidul</option>
                            <option value="Kabupaten Kulon Progo" {{ request('nama_kabupaten') == 'Kabupaten Kulon Progo' ? 'selected' : '' }}>Kabupaten Kulon Progo</option>
                            <option value="Kabupaten Bantul" {{ request('nama_kabupaten') == 'Kabupaten Bantul' ? 'selected' : '' }}>Kabupaten Bantul</option>
                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <select class="form-control" id="nama_kegiatan" name="nama_kegiatan">
                            <option value="">Semua Nama Kegiatan</option>
                            <option value="Tagana Masuk Sekolah" {{ request('nama_kegiatan') == 'Tagana Masuk Sekolah' ? 'selected' : '' }}>Tagana Masuk Sekolah</option>
                            <option value="Tagana Masuk Komunitas" {{ request('nama_kegiatan') == 'Tagana Masuk Komunitas' ? 'selected' : '' }}>Tagana Masuk Komunitas</option>
                            <option value="Pembentukan Kampung Siaga Bencana" {{ request('nama_kegiatan') == 'Pembentukan Kampung Siaga Bencana' ? 'selected' : '' }}>Pembentukan Kampung Siaga Bencana</option>
                            <option value="Penyaluran/Droping Logistik" {{ request('nama_kegiatan') == 'Penyaluran/Droping Logistik' ? 'selected' : '' }}>Penyaluran/Droping Logistik</option>
                            <option value="Mitigasi Bencana" {{ request('nama_kegiatan') == 'Mitigasi Bencana' ? 'selected' : '' }}>Mitigasi Bencana</option>
                            <option value="Peningkatan Kapasitas" {{ request('nama_kegiatan') == 'Peningkatan Kapasitas' ? 'selected' : '' }}>Peningkatan Kapasitas</option>
                            <option value="Kegiatan Sertifikasi" {{ request('nama_kegiatan') == 'Kegiatan Sertifikasi' ? 'selected' : '' }}>Kegiatan Sertifikasi</option>
                            <option value="Penyelenggaraan Dapur Umum" {{ request('nama_kegiatan') == 'Penyelenggaraan Dapur Umum' ? 'selected' : '' }}>Penyelenggaraan Dapur Umum</option>
                            <option value="Penyaluran/Droping Logistik KSB" {{ request('nama_kegiatan') == 'Penyaluran/Droping Logistik KSB' ? 'selected' : '' }}>Penyaluran/Droping Logistik KSB</option>
                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>

            <div class="mb-3">
                <a href="{{ route('kegiatan.create') }}" class="btn btn-success btn-custom">Tambah Kegiatan Baru</a>
                <a href="{{ route('export') }}" class="btn btn-success">Export to Excel</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Kegiatan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Peserta Terlibat</th>
                            <th scope="col">Personil Terlibat</th>
                            <th scope="col">Wilayah Terkait</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatan as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->peserta_terlibat }}</td>
                                <td>{{ $item->personil_terlibat }}</td>
                                <td>
                                    
                                        @foreach($item->wilayah as $wilayah)
                                            {{ $wilayah->nama_kabupaten }}<br>
                                        @endforeach

                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Aksi">
                                        <a href="{{ route('kegiatan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('kegiatan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada kegiatan tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
