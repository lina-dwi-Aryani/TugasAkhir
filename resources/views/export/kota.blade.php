@extends('adminlte::page')
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

            <h1 class="text-center">Data Kegiatan di Kabupaten Kota Madya</h1>
            <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-3">Tagana Masuk Sekolah</h2>
                  <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Kabupaten</th>
                        <th>Peserta Terlibat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taganaMasukSekolah as $kegiatan)
                        @foreach ($kegiatan->wilayahs as $wilayah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $wilayah->nama_kabupaten }}</td>
                                <td>{{ $kegiatan->peserta_terlibat }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Tagana Masuk Komunitas</h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Wilayah</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taganaMasukKomunitas as $kegiatan)
                        @foreach ($kegiatan->wilayahs as $wilayah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $wilayah->nama_kabupaten }}</td>
                                <td>{{ $kegiatan->peserta_terlibat }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        <div>
            <h2 class="text-center">Pembentukan Kampung Siaga Bencana</h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Wilayah</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ksb as $kegiatan)
                        @foreach ($kegiatan->wilayahs as $wilayah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $wilayah->nama_kabupaten }}</td>
                                <td>{{ $kegiatan->peserta_terlibat }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Penyaluran/Droping Logistik</h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Wilayah</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dl as $kegiatan)
                        @foreach ($kegiatan->wilayahs as $wilayah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $wilayah->nama_kabupaten }}</td>
                                <td>{{ $kegiatan->peserta_terlibat }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Mitigasi Bencana</h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Wilayah</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mb as $kegiatan)
                        @foreach ($kegiatan->wilayahs as $wilayah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $wilayah->nama_kabupaten }}</td>
                                <td>{{ $kegiatan->peserta_terlibat }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
            <div class="row">
            <div class="col-md-12">
            <h2 class="text-center">Pembentukan Kampung Siaga Bencana</h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Wilayah</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ksb as $kegiatan)
                        @foreach ($kegiatan->wilayahs as $wilayah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $wilayah->nama_kabupaten }}</td>
                                <td>{{ $kegiatan->peserta_terlibat }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
            <div class="row">
            <div class="col-md-12">
            <h2 class="text-center">Peningkatan Kapasitas</h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Wilayah</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pk as $kegiatan)
                        @foreach ($kegiatan->wilayahs as $wilayah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $wilayah->nama_kabupaten }}</td>
                                <td>{{ $kegiatan->peserta_terlibat }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
            <div class="row">
            <div class="col-md-12">
            <h2 class="text-center">Kegiatan Sertifikasi</h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Wilayah</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ks as $kegiatan)
                        @foreach ($kegiatan->wilayahs as $wilayah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $wilayah->nama_kabupaten }}</td>
                                <td>{{ $kegiatan->peserta_terlibat }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
            <div class="row">
                <div class="col-md-12">
            <h2 class="text-center">Penyelenggaraan Dapur Umum</h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Wilayah</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pd as $kegiatan)
                        @foreach ($kegiatan->wilayahs as $wilayah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $wilayah->nama_kabupaten }}</td>
                                <td>{{ $kegiatan->peserta_terlibat }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
            <div class="row">
                <div class="col-md-12">
            <h2 class="text-center">Penyaluran/Droping Logistik KSB</h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kegiatan</th>
                        <th>Nama Wilayah</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lksb as $kegiatan)
                        @foreach ($kegiatan->wilayahs as $wilayah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama_kegiatan }}</td>
                                <td>{{ $wilayah->nama_kabupaten }}</td>
                                <td>{{ $kegiatan->peserta_terlibat }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
   .table {
        margin: 20px auto;
        width: 90%;
    }
   .table th,.table td {
        text-align: center;
    }
   .table thead {
        background-color: #f2f2f2;
    }
   .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
   .table tbody tr:hover {
        background-color: #e2e2e2;
    }
</style>
@endpush