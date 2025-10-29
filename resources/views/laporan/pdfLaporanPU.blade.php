<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Petugas Ukur</title>
     <style>
    table, th, td {
      border: 1px solid black; /* 1px width, solid style, black color */
    }
    table {
      border-collapse: collapse; /* Merges adjacent cell borders */
    }
    </style>
    {{-- <link rel="stylesheet" href="{{ asset('css') }}/bootstrap.min.css"> --}}
</head>
<body>
    <div class="table-responsive">
        <table class="table table-sm table-bordered" style="font-size: 13px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>TAB</th>
                    <th>Selesai</th>
                    <th>Tutup</th>
                    <th>Sisa</th>
                    @foreach ($dat_bulan as $db)
                        <th>Petugas<br>Ukur<br>{{ $db }}</th>
                    @endforeach
                    <th>Total<br>Berkas<br>Petugas<br>Ukur</th>
                    <th>Petugas<br>Pemetaan</th>
                    <th>Pelaksana</th>
                    <th>Korsub</th>
                    <th>Kasi</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                    $ttl_berkas = 0;
                    $ttl_selesai = 0;
                    $ttl_tutup = 0;
                    $ttl_sisa = 0;
                    $ttl_pu = 0;
                    $ttl_pemetaan = 0;
                    $ttl_pelaksana = 0;
                    $ttl_korsub = 0;
                    $ttl_kasi = 0;
                @endphp
                @foreach ($laporanPU as $d)
                    @php
                        $ttl_berkas += $d['ttl_berkas'];
                        $ttl_selesai += $d['ttl_selesai'];
                        $ttl_tutup += $d['ttl_tutup'];
                        $ttl_sisa +=
                            $d['ttl_berkas'] - ($d['ttl_selesai'] + $d['ttl_tutup']);

                        $ttl_pemetaan += $d['ttl_pemetaan'];
                        $ttl_pelaksana += $d['ttl_pelaksana'];
                        $ttl_korsub += $d['ttl_korsub'];
                        $ttl_kasi += $d['ttl_kasi'];
                    @endphp
                    <tr style="text-align: center;">
                        <td>{{ $i++ }}</td>
                        <td>{{ $d['nm_petugas'] }}</td>
                        <td>{{ $d['ttl_berkas'] }}</td>
                        <td>{{ $d['ttl_selesai'] }}</td>
                        <td>{{ $d['ttl_tutup'] }}</td>
                        <td>{{ $d['ttl_berkas'] - ($d['ttl_selesai'] + $d['ttl_tutup']) }}</td>
                        @php
                            $tot_pu = 0;
                        @endphp
                        @foreach ($d['data_perbulan'] as $db)
                            <td>{{ $db }}</td>
                            @php
                                $tot_pu += $db;
                            @endphp
                        @endforeach
                        <td>{{ $tot_pu }}</td>
                        <td>{{ $d['ttl_pemetaan'] }}</td>
                        <td>{{ $d['ttl_pelaksana'] }}</td>
                        <td>{{ $d['ttl_korsub'] }}</td>
                        <td>{{ $d['ttl_kasi'] }}</td>
                    </tr>

                    @php
                        $ttl_pu += $tot_pu;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>

                <tr style="text-align: center;">
                    <td colspan="2"><b>Jumlah</b></td>
                    <td><b>{{ $ttl_berkas }}</b></td>
                    <td><b>{{ $ttl_selesai }}</b></td>
                    <td><b>{{ $ttl_tutup }}</b></td>
                    <td><b>{{ $ttl_sisa }}</b></td>
                    @foreach ($data_tot_bulan as $dtb)
                        <td><b>{{ $dtb['tot'] }}</b></td>
                    @endforeach
                    <td><b>{{ $ttl_pu }}</b></td>
                    <td><b>{{ $ttl_pemetaan }}</b></td>
                    <td><b>{{ $ttl_pelaksana }}</b></td>
                    <td><b>{{ $ttl_korsub }}</b></td>
                    <td><b>{{ $ttl_kasi }}</b></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>

