<div class="mb-2">
    <form action="{{ route('pdfLaporanPU') }}" method="get">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-file-pdf"></i> PDF</button>
        @foreach ($petugas_id as $p)
            <input type="hidden" name="petugas_id[]" value="{{ $p }}">
        @endforeach
        <input type="hidden" name="tahun" value="{{ $tahun }}">
    </form>
</div>
<div class="table-responsive">
    <table class="table table-sm table-bordered" style="font-size: 12px;">
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
                    $ttl_sisa += $d['ttl_berkas'] - ($d['ttl_selesai'] + $d['ttl_tutup']);

                    $ttl_pemetaan += $d['ttl_pemetaan'];
                    $ttl_pelaksana += $d['ttl_pelaksana'];
                    $ttl_korsub += $d['ttl_korsub'];
                    $ttl_kasi += $d['ttl_kasi'];
                @endphp
                <tr>
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
                    <td><a href="#modal_detail_laporan_pu" data-toggle="modal" class="detail_laporan_pu"
                            petugas_id="{{ $d['petugas_id'] }}"
                            tahun="{{ $tahun }}"><u>{{ $tot_pu }}</u></a></td>
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

            <tr>
                <td colspan="2"><b>Jumlah</b></td>
                <td><b>{{ $ttl_berkas }}</b></td>
                <td><b>{{ $ttl_selesai }}</b></td>
                <td><b>{{ $ttl_tutup }}</b></td>
                <td><b>{{ $ttl_sisa }}</b></td>
                @foreach ($data_tot_bulan as $dtb)
                    <td><b>{{ $dtb['tot'] }}</b></td>
                @endforeach
                <td><b>{{ $ttl_pu }}</b></td>
                <td><b><a href="#modal_detail_laporan_pu" data-toggle="modal" class="detail_laporan_lainnya"
                            tahun="{{ $tahun }}" proses_id="7"><u>{{ $ttl_pemetaan }}</u></a></b></td>
                <td><b><a href="#modal_detail_laporan_pu" data-toggle="modal" class="detail_laporan_pelaksana"
                            tahun="{{ $tahun }}" proses_id=""><u>{{ $ttl_pelaksana }}</u></a></b>
                </td>
                <td><b><a href="#modal_detail_laporan_pu" data-toggle="modal" class="detail_laporan_lainnya"
                            tahun="{{ $tahun }}" proses_id="9"><u>{{ $ttl_korsub }}</u></a></b></td>
                <td><b><a href="#modal_detail_laporan_pu" data-toggle="modal" class="detail_laporan_lainnya"
                            tahun="{{ $tahun }}" proses_id="11"><u>{{ $ttl_kasi }}</u></a></b></td>
            </tr>
        </tfoot>
    </table>
</div>
