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
            <select name="kecamatan_id" class="form-control select2bs4" required>
                @foreach ($kecamatan as $k)
                    <option value="{{ $k->id }}" {{ $peta->kecamatan_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nm_kecamatan }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label for="">Kelurahan</label>
            <select name="kelurahan_id" id="kelurahan_id" class="form-control select2bs4" required>
                @foreach ($kelurahan as $k)
                    <option value="{{ $k->id }}" {{ $peta->kelurahan_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nm_kelurahan }}</option>
                @endforeach
            </select>
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
            <select name="jenis_kertas" class="form-control" required>
                <option value="Kertas" {{ $peta->jenis_kertas == 'Kertas' ? 'selected' : '' }}>Kertas</option>
                <option value="Kalkir" {{ $peta->jenis_kertas == 'Kalkir' ? 'selected' : '' }}>Kalkir</option>
            </select>
        </div>
    </div>

</div>
