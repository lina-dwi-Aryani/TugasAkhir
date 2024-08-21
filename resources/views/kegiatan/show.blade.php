@extends('adminlte::page')

@section('title', 'Detail Kegiatan')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <h2 class="text-center mb-0">Detail Kegiatan</h2>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <h2 class="card-title font-weight-bold text-center">{{ $kegiatan->nama_kegiatan }}</h2>
                <br></br>
                
                <p class="card-text"><strong>Tanggal:</strong> {{ $kegiatan->tanggal }}</p>
                <p class="card-text"><strong>Waktu:</strong> {{ $kegiatan->waktu }}</p>
                <p class="card-text"><strong>Peserta Terlibat:</strong> {{ $kegiatan->peserta_terlibat }}</p>
                <p class="card-text"><strong>Uraian Kegiatan:</strong> {{ $kegiatan->uraian_kegiatan }}</p>
                <p class="card-text"><strong>Personil Terlibat:</strong> {{ $kegiatan->personil_terlibat }}</p>
            </div>
            <div class="form-group">
                <label for="foto">Foto Kegiatan:</label>
                @if($kegiatan->foto)
                    <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="Foto Kegiatan" class="img-fluid">
                @else
                    <p>Tidak ada foto untuk kegiatan ini.</p>
                @endif
            </div>
            <hr>
            
            <h5 class="card-title mt-4">Wilayah Terkait</h5>
            <div class="table-responsive">
                <table class="table table-bordered mt-3">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Kelurahan</th>
                            <th scope="col">RT</th>
                            <th scope="col">RW</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatan->wilayah as $wilayah)
                            <tr>
                                <td>{{ $wilayah->nama_kabupaten ?? '-' }}</td>
                                <td>{{ $wilayah->nama_kecamatan ?? '-' }}</td>
                                <td>{{ $wilayah->nama_kelurahan ?? '-' }}</td>
                                <td>{{ $wilayah->rt ?? '-' }}</td>
                                <td>{{ $wilayah->rw ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada wilayah terkait untuk kegiatan ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ route('kegiatan.index') }}" class="btn btn-primary btn-custom">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
