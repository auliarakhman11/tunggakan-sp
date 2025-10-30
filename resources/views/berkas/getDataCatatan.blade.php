<table class="table table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Catatan</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($catatan as $d)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ date("d/m/Y", strtotime($d->tgl)) }}</td>
                <td>{{ $d->isi_catatan }}</td>
                <td><button type="button" class="btn btn-xs btn-danger delete_catatan" catatan_id="{{ $d->id }}"><i
                            class="fas fa-trash"></i></button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<form id="form_tambah_catatan">
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control" name="tgl" required>
            </div>
        </div>
        <div class="col-7">
            <div class="form-group">
                <label for="">Catatan</label>
                <textarea name="isi_catatan" cols="30" rows="3" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-2">
            <input type="hidden" name="berkas_id" value="{{ $berkas_id }}">
            <button type="submit" class="btn btn-primary mt-5" id="btn_tambah_catatan"><i
                    class="fas fa-plus-circle"></i> Tambah</button>
        </div>
    </div>
</form>
