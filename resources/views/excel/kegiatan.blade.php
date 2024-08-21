<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Tambahkan gaya CSS untuk tampilan Excel */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <table>
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
            @foreach($kegiatans as $key => $kegiatan)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $kegiatan->nama_kegiatan }}</td>
                <td>{{ $kegiatan->tanggal }}</td>
                <td>{{ $kegiatan->waktu }}</td>
                <td>{{ $kegiatan->peserta_terlibat }}</td>
                <td>{{ $kegiatan->uraian_kegiatan }}</td>
                <td>{{ $kegiatan->personil_terlibat }}</td>
                <td>{{ $kegiatan->wilayah->pluck('nama_kabupaten')->implode(', ') }}</td>
                <td>{{ $kegiatan->wilayah->pluck('nama_kecamatan')->implode(', ') }}</td>
                <td>{{ $kegiatan->wilayah->pluck('nama_kelurahan')->implode(', ') }}</td>
                <td>{{ $kegiatan->wilayah->pluck('rt')->implode(', ') }}</td>
                <td>{{ $kegiatan->wilayah->pluck('rw')->implode(', ') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
