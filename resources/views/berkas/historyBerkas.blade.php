<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Proses</th>
            <th>Petugas</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($history as $d)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $d->tgl }}</td>
                <td>{{ $d->proses->nm_proses }}</td>
                <td>
                    @if ($d->petugasBerkas)
                        @foreach ($d->petugasBerkas as $pb)
                            {{ $pb->petugas->nm_petugas }},
                        @endforeach                        
                    @endif
                </td>
                <td>{{ $d->kembali == 1 ? 'Kembali' : 'Lanjut' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>