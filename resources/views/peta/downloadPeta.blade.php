<table class="table table-sm">
    <thead>
        <tr>
            <th>Nama File</th>
            <th>Jenis File</th>
            <th>Download</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peta->uploadPeta as $d)
            <tr>
                <td>{{ $d->nm_uplaod }}</td>
                <td>{{ $d->jenis_file }}</td>
                <td><a href="{{ route('downloadFilePeta', $d->file_name) }}" class="btn btn-sm btn-success"><i
                            class="fas fa-download"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
