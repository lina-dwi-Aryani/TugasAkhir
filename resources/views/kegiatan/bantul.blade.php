@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="card">
        <H1>Data Kegiatan di Kabupaten Bantul</H1>
        <div class="card-body">
            @foreach($kegiatanData as $key => $kegiatans)
                <h3>{{ ucwords(str_replace('_', ' ', $key)) }}</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Peserta Terlibat</th>
                            <th>Uraian Kegiatan</th>
                            <th>Personil Terlibat</th>
                            <th>Nama Kabupaten</th>
                            <th>Nama Kecamatan</th>
                            <th>Nama Kelurahan</th>
                            <th>RT</th>
                            <th>RW</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatans as $index => $kegiatan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kegiatan->nama_kegiatan }}</td>
                            <td>{{ $kegiatan->tanggal }}</td>
                            <td>{{ $kegiatan->waktu }}</td>
                            <td>{{ $kegiatan->peserta_terlibat }}</td>
                            <td>{{ $kegiatan->uraian_kegiatan }}</td>
                            <td>{{ $kegiatan->personil_terlibat }}</td>
                            <td>{{ $kegiatan->wilayah->nama_kabupaten }}</td>
                            <td>{{ $kegiatan->wilayah->nama_kecamatan }}</td>
                            <td>{{ $kegiatan->wilayah->nama_kelurahan }}</td>
                            <td>{{ $kegiatan->wilayah->rt }}</td>
                            <td>{{ $kegiatan->wilayah->rw }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
