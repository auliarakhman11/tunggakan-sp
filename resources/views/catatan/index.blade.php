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
                                <h4 class="float-left">List CataTan</h4>
                                <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#modal_tambah_catatan"><i class="fas fa-plus"></i> Tambah
                                    Data</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover" id="table_catatan" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                                <th>Catatan</th>
                                                <th>Upload/Download</th>
                                                <th>Aksi</th>
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

    <form id="form_tambah_catatan">
        <div class="modal fade" id="modal_tambah_catatan" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control" name="tgl" value="{{ date('Y-m-d') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Isi Catatan</label>
                                    <textarea name="isi_catatan" cols="30" rows="10" class="form-control" required></textarea>
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
                        <button type="submit" class="btn btn-primary" id="btn_tambah_catatan">Input</button>
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
                <div class="modal-body" id="table_download_catatan">

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="catatan_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <form id="form_edit_catatan">
        <div class="modal fade" id="modal_edit_catatan" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Peta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="table_edit_catatan">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_edit_catatan">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="form_upload_catatan">
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
                        <input type="hidden" name="id" id="inputan_id_catatan">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_upload_catatan">Upload</button>
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


            $('#table_catatan').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getDataCatatan') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tgl',
                        name: 'catatan.tgl'
                    },
                    {
                        data: 'isi_catatan',
                        name: 'catatan.isi_catatan'
                    },
                    {
                        data: 'btn_upload',
                        name: 'btn_upload'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
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


            $(document).on('submit', '#form_tambah_catatan', function(event) {
                event.preventDefault();
                $('#btn_tambah_catatan').attr('disabled', true);
                $('#btn_tambah_catatan').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');
                $.ajax({
                    url: "{{ route('addCatatan') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data) {
                            $("#btn_tambah_catatan").removeAttr("disabled");
                            $('#btn_tambah_catatan').html(
                                'Input'); //tombol simpan

                            $('#modal_tambah_catatan').modal('hide'); //modal hide

                            $('#form_tambah_catatan').trigger("reset");

                            var oTable = $('#table_catatan').dataTable(); //inialisasi datatable
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
                            $('#btn_tambah_catatan').html('Input');
                            $("#btn_tambah_catatan").removeAttr("disabled");
                        }

                    },
                    error: function(data) { //jika error tampilkan error pada console
                        console.log('Error:', data);

                        // var dt_error = '<div class="alert alert-danger">';
                        // jQuery.each(data.responseJSON.errors, function(key, message) {

                        //     dt_error += '<p>' + message + '</p>';

                        // });
                        // dt_error += '</div>';
                        // $('#message_error').html(dt_error);
                        // $('#message_error').show();
                        $('#btn_tambah_catatan').html('Input');
                        $("#btn_tambah_catatan").removeAttr("disabled");
                    }
                });

            });

            $(document).on('click', '.btn_download', function() {
                var catatan_id = $(this).attr('catatan_id');
                $('#catatan_id').val(catatan_id);

                $('#table_download_catatan').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');

                $.get('downloadDataCatatan/' + catatan_id, function(data) {
                    if (data) {
                        $('#table_download_catatan').html(data);
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'error',
                            title: 'Ada masalah'
                        });

                        $('#table_download_catatan').html('');
                    }

                });
            });

            $(document).on('click', '.btn_edit_catatan', function() {
                var catatan_id = $(this).attr('catatan_id');

                $('#table_edit_catatan').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');

                $.get('geteditCatatan/' + catatan_id, function(data) {
                    if (data) {
                        $('#table_edit_catatan').html(data);
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'error',
                            title: 'Ada masalah'
                        });

                        $('#table_edit_catatan').html('');
                    }

                });
            });


            $(document).on('submit', '#form_edit_catatan', function(event) {
                event.preventDefault();
                $('#btn_edit_catatan').attr('disabled', true);
                $('#btn_edit_catatan').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');
                $.ajax({
                    url: "{{ route('editCatatan') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data) {
                            $("#btn_edit_catatan").removeAttr("disabled");
                            $('#btn_edit_catatan').html(
                                'edit'); //tombol simpan

                            $('#modal_edit_catatan').modal('hide'); //modal hide

                            var oTable = $('#table_catatan').dataTable(); //inialisasi datatable
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
                            $('#btn_edit_catatan').html('edit');
                            $("#btn_edit_catatan").removeAttr("disabled");
                        }

                    },
                    error: function(data) { //jika error tampilkan error pada console

                        $('#btn_edit_catatan').html('edit');
                        $("#btn_edit_catatan").removeAttr("disabled");
                    }
                });

            });

            $(document).on('click', '.btn_delete_catatan', function() {

                if (confirm('Apakah anda yakin ingin menghapus data peta?')) {
                    var catatan_id = $(this).attr('catatan_id');
                    $.get('deleteCatatan/' + catatan_id, function(data) {
                        var oTable = $('#table_catatan').dataTable(); //inialisasi datatable
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

                var catatan_id = $(this).attr('catatan_id');
                $("#inputan_id_catatan").val(catatan_id);

            });

            $(document).on('submit', '#form_upload_catatan', function(event) {
                event.preventDefault();
                $('#btn_upload_catatan').attr('disabled', true);
                $('#btn_upload_catatan').html(
                    'Loading <div class="ld"><div></div><div></div><div></div></div>');
                $.ajax({
                    url: "{{ route('uploadCatatan') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data) {
                            $("#btn_upload_catatan").removeAttr("disabled");
                            $('#btn_upload_catatan').html(
                                'Upload'); //tombol simpan

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
                            $('#btn_upload_catatan').html('Upload');
                            $("#btn_upload_catatan").removeAttr("disabled");
                        }

                    },
                    error: function(data) { //jika error tampilkan error pada console

                        $('#btn_upload_catatan').html('Upload');
                        $("#btn_upload_catatan").removeAttr("disabled");
                    }
                });

            });


            $(document).on('click', '.btn_delete_file_catatan', function() {

                if (confirm('Apakah anda yakin ingin menghapus data catatan?')) {
                    var id = $(this).attr('upload_id');
                    $.get('deleteFileCatatan/' + id, function(data) {

                        if (data) {
                            var catatan_id = $('#catatan_id').val();
                            $.get('downloadDataCatatan/' + catatan_id, function(data) {
                                if (data) {
                                    $('#table_download_catatan').html(data);
                                } else {
                                    Swal.fire({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        icon: 'error',
                                        title: 'Ada masalah'
                                    });

                                    $('#table_download_catatan').html('');
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
