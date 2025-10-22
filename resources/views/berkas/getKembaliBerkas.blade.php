<table class="table table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Proses</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($proses as $d)
            <tr
                class="{{ $d->id == $proses_id ? 'bg-warning text-light' : ($d->id == 14 ? 'bg-danger text-light' : '') }}">
                <td>{{ $i++ }}</td>
                <td>{{ $d->nm_proses }}</td>
                <td>
                    @if ($d->id != $proses_id)
                        <button class="btn btn-xs btn-warning text-light btn-kembali-berkas"
                            berkas_id="{{ $berkas_id }}" proses_id="{{ $d->id }}" type="button"><i
                                class="fas fa-arrow-circle-left"></i></button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
