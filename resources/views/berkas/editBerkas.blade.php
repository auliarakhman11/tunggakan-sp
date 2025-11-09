<div class="row">

    <input type="hidden" name="id" value="{{ $berkas->id }}">

    <div class="col-6">
        <div class="form-group">
            <label for="">Tanggal Masuk</label>
            <input type="date" class="form-control" name="tgl" value="{{ $berkas->tgl }}" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Kelurahan</label>
            <input type="text" class="form-control" name="kelurahan" value="{{ $berkas->kelurahan }}" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Nomor Berkas</label>
            <input type="text" class="form-control" name="no_berkas" value="{{ $berkas->no_berkas }}" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Tahun</label>
            <input type="text" class="form-control" name="tahun" value="{{ $berkas->tahun }}" required>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label for="">Nama Pemohon</label>
            <input type="text" class="form-control" name="nm_pemohon" value="{{ $berkas->nm_pemohon }}" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Jenis Kegiatan</label>
            <input type="text" class="form-control" name="jenis_kegiatan" value="{{ $berkas->jenis_kegiatan }}"
                required>
        </div>
    </div>

</div>
