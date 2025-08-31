@extends('template.master')
@section('content')

    <style>
        .blink {
            animation: blink 1s steps(1, end) infinite;
        }

        @keyframes blink {
            0% {
                background-color: red;
                color: white;
            }

            50% {
                background-color: orange;
            }

            100% {
                background-color: yellow;
            }
        }

        .dropdown-item:hover {
            background-color: #007BFF;
            color: white;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol> --}}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="float-left">List Peta Sesuai Posisi</h4>
                                {{-- <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#modal_tambah_peta"><i class="fas fa-plus"></i> Tambah
                                    Data</button> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover" id="table_peta" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Peta</th>
                                                <th>Nomor Peta</th>
                                                <th>Jenis Kegiatan</th>
                                                <th>Kecamatan</th>
                                                <th>Desa/Kelurahan</th>
                                                <th>Tahun Pembuatan</th>
                                                <th>Upload/Download</th>
                                                <th>Sesuai Posisi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <form id="form_tambah_peta">
        <div class="modal fade" id="modal_tambah_peta" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nama Peta</label>
                                    <input type="text" class="form-control" name="nm_peta" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nomor Peta</label>
                                    <input type="text" class="form-control" name="no_peta">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Kecamatan</label>
                                    <input type="text" class="form-control" name="kecamatan">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Kelurahan</label>
                                    <input type="text" class="form-control" name="kelurahan">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Jenis Kegiatan</label>
                                    <input type="text" class="form-control" name="jenis_kegiatan">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tahun Pembuatan</label>
                                    <input type="text" class="form-control" name="tahun_pembuatan">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Jenis Kertas</label>
                                    <input type="text" class="form-control" name="jenis_kertas">
                                </div>
                            </div>

                            <div class="col-12">
                                <table class="table table-xs">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Upload</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control" name="nm_uplaod1"></td>
                                            <td><input type="file" name="file_name1" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="nm_uplaod2"></td>
                                            <td><input type="file" name="file_name2" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="nm_uplaod3"></td>
                                            <td><input type="file" name="file_name3" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_tambah_peta">Input</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal_download" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Download</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="table_download_peta">

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="peta_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <form id="form_edit_peta">
        <div class="modal fade" id="modal_edit_peta" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Peta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="table_edit_peta">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_edit_peta">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="form_upload_peta">
        <div class="modal fade" id="modal_uplaod" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Peta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="inputan_id_peta">
                        <table class="table table-xs">
                            <thead>
                                <tr>
                                    <th class="text-center">Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="file" name="file_name1" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="file" name="file_name2" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="file" name="file_name3" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_upload_peta">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </form>





@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).ready(function() {

            $('#table_peta').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getPetaSesuai') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nm_peta',
                        name: 'peta.nm_peta'
                    },
                    {
                        data: 'no_peta',
                        name: 'peta.no_peta'
                    },
                    {
                        data: 'jenis_kegiatan',
                        name: 'peta.jenis_kegiatan'
                    },
                    {
                        data: 'kecamatan',
                        name: 'peta.kecamatan'
                    },
                    {
                        data: 'kelurahan',
                        name: 'peta.kelurahan'
                    },
                    {
                        data: 'tahun_pembuatan',
                        name: 'peta.tahun_pembuatan'
                    },
                    {
                        data: 'btn_upload',
                        name: 'btn_upload'
                    },
                    {
                        data: 'sesuai',
                        name: 'sesuai'
                    }
                ],
                order: [],
                columnDefs: [{
                        "targets": 0,
                        "orderable": false
                    },
                    {
                        "searchable": false,
                        "targets": 0
                    }
                ],
            });


            $(document).on('change', '#kecamatan_id', function() {
                var kecamatan_id = $(this).val();

                if (kecamatan_id) {
                    $.get('find-kelurahan/' + kecamatan_id, function(data) {
                        $('#kelurahan_id').html(data);
                    });
                } else {
                    $('#kelurahan_id').html('<option value="">Pilih Kelurahan/Desa..</option>');
                }


            });


            $(document).on('submit', '#form_tambah_peta', function(event) {
                event.preventDefault();
                $('#btn_tambah_peta').attr('disabled', true);
                $('#btn_tambah_peta').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');
                $.ajax({
                    url: "{{ route('addPeta') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data) {
                            $("#btn_tambah_peta").removeAttr("disabled");
                            $('#btn_tambah_peta').html(
                                'Input'); //tombol simpan

                            $('#modal_tambah_peta').modal('hide'); //modal hide

                            $('#form_tambah_peta').trigger("reset");
                            $('.select2bs4').val('');
                            $('.select2bs4').select2({
                                theme: 'bootstrap4',
                                tags: true,
                            }).trigger('change');

                            var oTable = $('#table_peta').dataTable(); //inialisasi datatable
                            oTable.fnDraw(false); //reset datatable

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Data scan berhasil diinput'
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'error',
                                title: 'Ada masalah'
                            });
                            $('#btn_tambah_peta').html('Input');
                            $("#btn_tambah_peta").removeAttr("disabled");
                        }

                    },
                    error: function(data) { //jika error tampilkan error pada console
                        // console.log('Error:', data);

                        // var dt_error = '<div class="alert alert-danger">';
                        // jQuery.each(data.responseJSON.errors, function(key, message) {

                        //     dt_error += '<p>' + message + '</p>';

                        // });
                        // dt_error += '</div>';
                        // $('#message_error').html(dt_error);
                        // $('#message_error').show();
                        $('#btn_tambah_peta').html('Input');
                        $("#btn_tambah_peta").removeAttr("disabled");
                    }
                });

            });

            $(document).on('click', '.btn_download', function() {
                var peta_id = $(this).attr('peta_id');
                $('#peta_id').val(peta_id);

                $('#table_download_peta').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');

                $.get('downloadDataSesuai/' + peta_id, function(data) {
                    if (data) {
                        $('#table_download_peta').html(data);
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'error',
                            title: 'Ada masalah'
                        });

                        $('#table_download_peta').html('');
                    }

                });
            });

            $(document).on('click', '.btn_edit_peta', function() {
                var peta_id = $(this).attr('peta_id');

                $('#table_edit_peta').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');

                $.get('geteditPeta/' + peta_id, function(data) {
                    if (data) {
                        $('#table_edit_peta').html(data);
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'error',
                            title: 'Ada masalah'
                        });

                        $('#table_edit_peta').html('');
                    }

                });
            });


            $(document).on('submit', '#form_edit_peta', function(event) {
                event.preventDefault();
                $('#btn_edit_peta').attr('disabled', true);
                $('#btn_edit_peta').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');
                $.ajax({
                    url: "{{ route('editPeta') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data) {
                            $("#btn_edit_peta").removeAttr("disabled");
                            $('#btn_edit_peta').html(
                                'edit'); //tombol simpan

                            $('#modal_edit_peta').modal('hide'); //modal hide

                            var oTable = $('#table_peta').dataTable(); //inialisasi datatable
                            oTable.fnDraw(false); //reset datatable

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Data scan berhasil diinput'
                            });

                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'error',
                                title: 'Ada masalah'
                            });
                            $('#btn_edit_peta').html('edit');
                            $("#btn_edit_peta").removeAttr("disabled");
                        }

                    },
                    error: function(data) { //jika error tampilkan error pada console

                        $('#btn_edit_peta').html('edit');
                        $("#btn_edit_peta").removeAttr("disabled");
                    }
                });

            });

            $(document).on('click', '.btn_delete_peta', function() {

                if (confirm('Apakah anda yakin ingin menghapus data peta?')) {
                    var peta_id = $(this).attr('peta_id');
                    $.get('deletePeta/' + peta_id, function(data) {
                        var oTable = $('#table_peta').dataTable(); //inialisasi datatable
                        oTable.fnDraw(false); //reset datatable

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Data berhasil dihapus'
                        });
                    });
                }

            });

            $(document).on('click', '.btn_upload', function() {

                var peta_id = $(this).attr('peta_id');
                $("#inputan_id_peta").val(peta_id);

            });

            $(document).on('submit', '#form_upload_peta', function(event) {
                event.preventDefault();
                $('#btn_upload_peta').attr('disabled', true);
                $('#btn_upload_peta').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');
                $.ajax({
                    url: "{{ route('uploadPetaSesuai') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data) {
                            $("#btn_upload_peta").removeAttr("disabled");
                            $('#btn_upload_peta').html(
                                'Upload'); //tombol simpan

                            var oTable = $('#table_peta').dataTable(); //inialisasi datatable
                            oTable.fnDraw(false); //reset datatable

                            $('#modal_uplaod').modal('hide'); //modal hide


                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Data scan berhasil diupload'
                            });

                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'error',
                                title: 'Ada masalah'
                            });
                            $('#btn_upload_peta').html('Upload');
                            $("#btn_upload_peta").removeAttr("disabled");
                        }

                    },
                    error: function(data) { //jika error tampilkan error pada console
                        console.log('Error:', data);
                        $('#btn_upload_peta').html('Upload');
                        $("#btn_upload_peta").removeAttr("disabled");
                    }
                });

            });


            $(document).on('click', '.btn_delete_file_peta', function() {

                if (confirm('Apakah anda yakin ingin menghapus data peta?')) {
                    var id = $(this).attr('upload_id');
                    $.get('deleteFilePeta/' + id, function(data) {

                        if (data) {
                            var peta_id = $('#peta_id').val();
                            $.get('downloadDataSesuai/' + peta_id, function(data) {
                                if (data) {
                                    $('#table_download_peta').html(data);
                                } else {
                                    Swal.fire({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        icon: 'error',
                                        title: 'Ada masalah'
                                    });

                                    $('#table_download_peta').html('');
                                }

                            });

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Data berhasil dihapus'
                            });

                        } else {

                        }


                    });
                }

            });


        });
    </script>
@endsection
@endsection
