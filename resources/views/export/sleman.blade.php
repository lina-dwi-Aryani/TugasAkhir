@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">REKAP KEJADIAN BENCANA Kabupaten</div>
        <div class="card-body">
            @foreach($kegiatanData as $key => $kegiatans)
                <h5 style="background-color: {{ getColor($key) }}; padding: 10px;">{{ ucwords(str_replace('_', ' ', $key)) }}</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Nama Kecamatan</th>
                            <th>RW</th>
                            <th>RT</th>
                            <th>Padukuhan</th>
                            <th>Kalurahan</th>
                            <th>Kapanewon</th>
                            <th>Kabupaten</th>
                            <th>Peserta Terlibat</th>
                            <th>Uraian Kegiatan</th>
                            <th>Personil Terlibat</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatans as $index => $kegiatan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kegiatan->kode }}</td>
                            <td>{{ $kegiatan->tanggal }}</td>
                            <td>{{ $kegiatan->waktu }}</td>
                            <td>{{ optional($kegiatan->wilayah)->nama_kecamatan }}</td>
                            <td>{{ optional($kegiatan->wilayah)->rw }}</td>
                            <td>{{ optional($kegiatan->wilayah)->rt }}</td>
                            <td>{{ optional($kegiatan->wilayah)->padukuhan }}</td>
                            <td>{{ optional($kegiatan->wilayah)->kalurahan }}</td>
                            <td>{{ optional($kegiatan->wilayah)->kapanewon }}</td>
                            <td>{{ optional($kegiatan->wilayah)->kabupaten }}</td>
                            <td>{{ $kegiatan->peserta_terlibat }}</td>
                            <td>{{ $kegiatan->uraian_kegiatan }}</td>
                            <td>{{ $kegiatan->personil_terlibat }}</td>
                            <td>
                                @if($kegiatan->foto)
                                    <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="Foto Kegiatan" width="100">
                                @else
                                    Tidak ada foto
                                @endif
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

@php
function getColor($key)
{
    $colors = [
        'taganaMasukSekolah' => '#A3E4D7',
        'taganaMasukKomunitas' => '#A3E4D7',
        'pembentukanKampungSiagaBencana' => '#76D7C4',
        'penyaluranDropingLogistik' => '#58D68D',
        'mitigasiBencana' => '#58D68D',
        'peningkatanKapasitas' => '#3498DB',
        'kegiatanSertifikasi' => '#A6ACAF',
        'penyelenggaraanDapurUmum' => '#3498DB',
        'penyaluranDropingLogistikKSB' => '#58D68D'
    ];

    return $colors[$key] ?? '#FFFFFF';
}
@endphp
