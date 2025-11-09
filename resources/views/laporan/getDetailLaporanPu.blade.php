<div class="table-responsive">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Proses</th>
                <th>Nomor</th>
                <th>Tahun</th>
                <th>Nama Pemohon</th>
                <th>Jenis Kegiatan</th>
                <th>Kelurahan</th>
                <th>Petugas Ukur</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dt_history as $index => $d)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ date('d/m/Y', strtotime($d->tgl)) }}</td>
                    <td>{{ $d->nm_proses }}</td>
                    <td>{{ $d->no_berkas }}</td>
                    <td>{{ $d->tahun }}</td>
                    <td>{{ $d->nm_pemohon }}</td>
                    <td>{{ $d->jenis_kegiatan }}</td>
                    <td>{{ $d->kelurahan }}</td>
                    <td>{{ $d->nm_petugas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
