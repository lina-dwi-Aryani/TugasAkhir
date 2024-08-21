@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Data Kegiatan di Kabupaten GunungKidul</div>
        <div class="card-body">
            @foreach($kegiatanData as $key => $kegiatans)
                <h5>{{ ucwords(str_replace('_', ' ', $key)) }}</h5>
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
                           
                                @foreach($kegiatan->wilayah as $wilayah)
                                    <td>{{ $wilayah->nama_kabupaten }}</td>
                                    <td>{{ $wilayah->nama_kecamatan }}</td>
                                    <td>{{ $wilayah->nama_kelurahan }}</td>
                                    <td>{{ $wilayah->rt }}</td>
                                    <td>{{ $wilayah->rw }}</td>
                                    
                                @endforeach
                            </td>
                            
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
