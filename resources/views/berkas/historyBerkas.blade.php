<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Proses</th>
            <th>Petugas</th>
            <th>Surat Tugas</th>
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
                <td class="text-center">
                    @if ($d->file_name !== null)
                        <a class="btn btn-sm btn-primary btn_lihat_file" href="#model_lihat_file" data-toggle="modal"
                            file_name="{{ $d->file_name }}" jenis_file="{{ $d->jenis_file }}">Lihat ST <i class="fa fa-eye"
                                aria-hidden="true"></i></a>
                    @endif
                </td>
                <td>{{ $d->kembali == 1 ? 'Kembali' : 'Lanjut' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
