<table class="table table-sm">
    <thead>
        <tr>
            <th>Nama File</th>
            <th>Jenis File</th>
            <th>Download</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($catatan->uploadCatatanScan as $d)
            <tr>
                <td>{{ $d->nm_uplaod }}</td>
                <td>{{ $d->jenis_file }}</td>
                <td><a href="{{ route('downloadFileCatatan', $d->file_name) }}" target="_blank"
                        class="btn btn-xs btn-success"><i class="fas fa-download"></i></a></td>
                <td><a href="javascript:void(0)" class="btn btn-xs btn-danger btn_delete_file_catatan"
                        upload_id="{{ $d->id }}"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
