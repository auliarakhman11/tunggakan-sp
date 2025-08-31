<div class="row">

    <input type="hidden" name="id" value="{{ $peta->id }}">

    <div class="col-6">
        <div class="form-group">
            <label for="">Nama Peta</label>
            <input type="text" class="form-control" name="nm_peta" value="{{ $peta->nm_peta }}" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Nomor Peta</label>
            <input type="text" class="form-control" name="no_peta" value="{{ $peta->no_peta }}">
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label for="">Kecamatan</label>
            <input type="text" class="form-control" name="kecamatan" value="{{ $peta->kecamatan }}">
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label for="">Kelurahan</label>
            <input type="text" class="form-control" name="kelurahan" value="{{ $peta->kelurahan }}">
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label for="">Jenis Kegiatan</label>
            <input type="text" class="form-control" name="jenis_kegiatan" value="{{ $peta->jenis_kegiatan }}">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Tahun Pembuatan</label>
            <input type="text" class="form-control" name="tahun_pembuatan" value="{{ $peta->tahun_pembuatan }}">
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label for="">Jenis Kertas</label>
            <input type="text" class="form-control" name="jenis_kertas" value="{{ $peta->jenis_kertas }}">
        </div>
    </div>

</div>
