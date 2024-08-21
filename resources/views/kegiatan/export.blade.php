<table class="table table-bordered">
    <thead style="color: #fff; background-color: #a8f043;">
        <tr>
            <th>No</th>
            <th>JENIS BENCANA</th>
            <th>KOTA YK</th>
            <th>BANTUL</th>
            <th>KULON PROGO</th>
            <th>GUNUNGKIDUL</th>
            <th>SLEMAN</th>
            <th width="240px">JUMLAH</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
            $totalJumlah = 0;
            $bencanaUnik = $kegiatan->unique('nama_kegiatan');
            $namaBencana = [
                'Tagana Masuk Sekolah',
                'Tagana Masuk Komunitas',
                'Pembentukan Kampung Siaga Bencana',
                'Penyaluran/Droping Logistik',
                'Mitigasi Bencana',
                'Peningkatan Kapasitas',
                'Kegiatan Sertifikasi',
                'Penyelenggaraan Dapur Umum',
                'Penyaluran/Droping Logistik KSB',
            ];

            // Convert all items in $namaBencana array to lowercase for consistency
            $namaBencana = array_map('strtolower', $namaBencana);
        @endphp

        @foreach($namaBencana as $key => $value)
            @php
                $totalPerBencana = $kegiatan->where('nama_kegiatan', $value);
                
                // Count the number of occurrences for each kabupaten
                $jumlahPerKabupaten = [
                    'DIY' => $totalPerBencana->whereHas('wilayahs', function ($query) {
                        $query->where('nama_kabupaten', 'Kotamadya Yogyakarta');
                    })->count(),
                    'bantul' => $totalPerBencana->whereHas('wilayahs', function ($query) {
                        $query->where('nama_kabupaten', 'Kabupaten Bantul');
                    })->count(),
                    'kulon progo' => $totalPerBencana->whereHas('wilayahs', function ($query) {
                        $query->where('nama_kabupaten', 'Kabupaten Kulon Progo');
                    })->count(),
                    'gunungkidul' => $totalPerBencana->whereHas('wilayahs', function ($query) {
                        $query->where('nama_kabupaten', 'Kabupaten Gunungkidul');
                    })->count(),
                    'sleman' => $totalPerBencana->whereHas('wilayahs', function ($query) {
                        $query->where('nama_kabupaten', 'Kabupaten Sleman');
                    })->count(),
                ];

                $total = array_sum($jumlahPerKabupaten);
                $totalJumlah += $total;
            @endphp

            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ Str::title($value) }}</td>
                <td>{{ $jumlahPerKabupaten['Kotamadya Yogyakarta'] }}</td>
                <td>{{ $jumlahPerKabupaten['Kabupaten Bantul'] }}</td>
                <td>{{ $jumlahPerKabupaten['Kabupaten Kulon Progo'] }}</td>
                <td>{{ $jumlahPerKabupaten['Kabupaten Gunungkidul'] }}</td>
                <td>{{ $jumlahPerKabupaten['Kabupaten Sleman'] }}</td>
                <td>{{ $total }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="7" style="text-align: right;"><strong>Total Keseluruhan:</strong></td>
            <td>{{ $totalJumlah }}</td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>JENIS KEGIATAN</th>
            <th>JANUARI</th>
            <th>FEBRUARI</th>
            <th>MARET</th>
            <th>APRIL</th>
            <th>MEI</th>
            <th>JUNI</th>
            <th>JULI</th>
            <th>AGUSTUS</th>
            <th>SEPTEMBER</th>
            <th>OKTOBER</th>
            <th>NOVEMBER</th>
            <th>DESEMBER</th>
            <th width="240px">JUMLAH</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalJumlah = 0;
        @endphp

        @foreach($namaBencana as $key => $value)
            @php
                $totalByMonth = [];
                for ($month = 1; $month <= 12; $month++) {
                    $formattedMonth = str_pad($month, 2, '0', STR_PAD_LEFT);
                    $totalByMonth[$month] = $kegiatan->filter(function ($item) use ($value, $formattedMonth) {
                        $tanggal = new DateTime($item->tanggal);
                        return $tanggal->format('m') === $formattedMonth && Str::lower($item->nama_kegiatan) === $value;
                    })->count();
                }
                $total = array_sum($totalByMonth);
                $totalJumlah += $total;
            @endphp

            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ Str::title($value) }}</td>
                @foreach($totalByMonth as $total)
                    <td>{{ $total }}</td>
                @endforeach
                <td>{{ $total }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="14" style="text-align: right;"><strong>Total Keseluruhan:</strong></td>
            <td>{{ $totalJumlah }}</td>
        </tr>
    </tbody>
</table>
