<div class="row">
    <input type="hidden" name="id" value="{{ $catatan->id }}">

    <div class="col-12">
        <div class="form-group">
            <label for="">Tanggal</label>
            <input type="date" class="form-control" name="tgl" value="{{ $catatan->tgl }}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Isi Catatan</label>
            <textarea name="isi_catatan" cols="30" rows="10" class="form-control" required>{{ $catatan->isi_catatan }}</textarea>
        </div>
    </div>


</div>
