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
                                <h4 class="float-left">List Berkas</h4>
                                <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#modal_tambah_berkas"><i class="fas fa-plus"></i> Tambah
                                    Data</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover" id="table_berkas" width="100%" style="font-size: 13px;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                                <th>Proses</th>
                                                <th>Nomor</th>
                                                <th>Tahun</th>
                                                <th>Kelurahan</th>
                                                <th>Aksi</th>
                                                <th>Manipulasi</th>
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

    <form id="form_tambah_berkas">
        <div class="modal fade" id="modal_tambah_berkas" role="dialog" aria-labelledby="exampleModalLabel"
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

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tanggal Masuk</label>
                                    <input type="date" class="form-control" name="tgl" value="{{ date('Y-m-d') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nomor Berkas</label>
                                    <input type="text" class="form-control" id="no_berkas" name="no_berkas" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tahun</label>
                                    <input type="text" class="form-control" id="tahun" name="tahun" required>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_tambah_berkas">Input</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="form_edit_berkas">
        <div class="modal fade" id="modal_edit_berkas" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="table_edit_berkas">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_edit_berkas">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <form id="form_lanjut_berkas">
        <div class="modal fade" id="modal_lanjut_berkas" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Lanjut Berkas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="col-12">
                                        <label for="">Tanggal</label>
                                        <input class="form-control" type="date" value="{{ date('Y-m-d') }}"
                                            name="tgl" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="table_lanjut_berkas"></div>
                        <div id="list_petugas"></div>
                        <div id="button_table_tambah_pegawai"></div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="berkas_id" id="berkas_id_lanjut">
                        <input type="hidden" name="proses_id" id="proses_id_lanjut">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_lanjut_berkas">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal_catatan_berkas" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Catatan Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="table_catatan_berkas">

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="berkas_id_catatan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_kembali_berkas" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Berkas Kembali</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="table_kembali_berkas">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_history_berkas" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Berkas Kembali</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="table_history_berkas">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>





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


            $('#table_berkas').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getBerkas') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tanggal',
                        name: 'dt_tanggal.tanggal'
                    }, 
                    {
                        data: 'proses.nm_proses',
                        name: 'proses.nm_proses'
                    },
                    {
                        data: 'no_berkas',
                        name: 'berkas.no_berkas'
                    },
                    {
                        data: 'tahun',
                        name: 'berkas.tahun'
                    },
                    {
                        data: 'kelurahan',
                        name: 'berkas.kelurahan'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                    {
                        data: 'manipulasi',
                        name: 'manipulasi'
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


            $(document).on('submit', '#form_tambah_berkas', function(event) {
                event.preventDefault();
                $('#btn_tambah_berkas').attr('disabled', true);
                $('#btn_tambah_berkas').html(
                    '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );
                $.ajax({
                    url: "{{ route('addBerkas') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data) {
                            $("#btn_tambah_berkas").removeAttr("disabled");
                            $('#btn_tambah_berkas').html(
                                'Input'); //tombol simpan

                            $('#modal_tambah_berkas').modal('hide'); //modal hide

                            // $('#form_tambah_berkas').trigger("reset");
                            $('#kelurahan').val('');
                            $('#no_berkas').val('');
                            $('#tahun').val('');

                            var oTable = $('#table_berkas').dataTable(); //inialisasi datatable
                            oTable.fnDraw(false); //reset datatable

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Data berhasil diinput'
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
                            $('#btn_tambah_berkas').html('Input');
                            $("#btn_tambah_berkas").removeAttr("disabled");
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
                        $('#btn_tambah_berkas').html('Input');
                        $("#btn_tambah_berkas").removeAttr("disabled");
                    }
                });

            });

            $(document).on('click', '.btn_edit_berkas', function() {
                var berkas_id = $(this).attr('berkas_id');

                $('#table_edit_berkas').html(
                    '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );

                $.get('geteditBerkas/' + berkas_id, function(data) {
                    if (data) {
                        $('#table_edit_berkas').html(data);
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'error',
                            title: 'Ada masalah'
                        });

                        $('#table_edit_berkas').html('');
                    }

                });
            });


            $(document).on('submit', '#form_edit_berkas', function(event) {
                event.preventDefault();
                $('#btn_edit_berkas').attr('disabled', true);
                $('#btn_edit_berkas').html(
                    '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );
                $.ajax({
                    url: "{{ route('editBerkas') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data) {
                            $("#btn_edit_berkas").removeAttr("disabled");
                            $('#btn_edit_berkas').html(
                                'edit'); //tombol simpan

                            $('#modal_edit_berkas').modal('hide'); //modal hide

                            var oTable = $('#table_berkas').dataTable(); //inialisasi datatable
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
                            $('#btn_edit_berkas').html('edit');
                            $("#btn_edit_berkas").removeAttr("disabled");
                        }

                    },
                    error: function(data) { //jika error tampilkan error pada console

                        $('#btn_edit_berkas').html('edit');
                        $("#btn_edit_berkas").removeAttr("disabled");
                    }
                });

            });

            $(document).on('click', '.btn_delete_berkas', function() {

                if (confirm('Apakah anda yakin ingin menghapus data peta?')) {
                    var berkas_id = $(this).attr('berkas_id');
                    $.get('deleteBerkas/' + berkas_id, function(data) {
                        var oTable = $('#table_berkas').dataTable(); //inialisasi datatable
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

            var dt_proses = ['dt_proses','Korsub (Penunjukan ST)', 'Pelaksana', 'Kasi', 'Petugas Ukur', 'Pelaksana', 'Pemetaan', 'Pelaksana', 'Korsub', 'Pelaksana', 'Kasi', 'Pelaksana', 'Selesai'];

            $(document).on('click', '.btn_lanjut_berkas', function() {
                var berkas_id = $(this).attr('berkas_id');
                var proses_id = $(this).attr('proses_id');
                var proses_selanjutnya = dt_proses[proses_id];
                

                $('#berkas_id_lanjut').val(berkas_id);
                $('#proses_id_lanjut').val(proses_id);

                if (proses_id == 4 || proses_id == 6) {
                    $('#table_lanjut_berkas').html(
                        '<h4>Apakah anda yakin ingin melanjutkan berkas ke '+proses_selanjutnya+'?</h4> <div class="row"><div class="col-10"><div class="form-group"><label for="">Petugas</label><select name="petugas_id[]" class="form-control" required><option value="">Pilih Pegawai</option>@foreach ($petugas as $p)<option value="{{ $p->id }}">{{ $p->nm_petugas }}</option>@endforeach</select></div></div><div class="col-2"></div></div>'
                    );
                    $('#list_petugas').html('');
                    $('#button_table_tambah_pegawai').html(
                        '<button class="btn btn-sm btn-success float-right" type="button" id="button_tambah_pegawai">+</button>'
                    );
                } else {
                    $('#table_lanjut_berkas').html('<h4>Apakah anda yakin ingin melanjutkan berkas ke '+proses_selanjutnya+'?</h4>');
                    $('#list_petugas').html('');
                    $('#button_table_tambah_pegawai').html('');
                }


            });


            var count_petugas_berkas = 1;
            $(document).on('click', '#button_tambah_pegawai', function() {
                count_petugas_berkas = count_petugas_berkas + 1;
                var html_code = '<div class="row mt-2" id="row' + count_petugas_berkas + '">';

                html_code +=
                    '<div class="col-10"><div class="form-group"><select name="petugas_id[]" class="form-control" required><option value="">Pilih Pegawai</option>@foreach ($petugas as $p)<option value="{{ $p->id }}">{{ $p->nm_petugas }}</option>@endforeach</select></div></div>';

                html_code += '<div class="col-2"><button type="button" data-row="row' +
                    count_petugas_berkas +
                    '" class="btn btn-danger btn-sm remove_petugas_berkas"><i class="fas fa-minus"></></button></div>';

                html_code += "</div>";

                $('#list_petugas').append(html_code);
            });


            $(document).on('click', '.remove_petugas_berkas', function() {
                var delete_row = $(this).data("row");
                $('#' + delete_row).remove();
            });


            $(document).on('submit', '#form_lanjut_berkas', function(event) {
                event.preventDefault();
                $('#btn_lanjut_berkas').attr('disabled', true);
                $('#btn_lanjut_berkas').html(
                    '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );
                $.ajax({
                    url: "{{ route('lanjutBerkas') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data) {
                            $("#btn_lanjut_berkas").removeAttr("disabled");
                            $('#btn_lanjut_berkas').html(
                                'Lanjut'); //tombol simpan

                            $('#modal_lanjut_berkas').modal('hide'); //modal hide

                            var oTable = $('#table_berkas').dataTable(); //inialisasi datatable
                            oTable.fnDraw(false); //reset datatable

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Berhasil melanjutkan berkas'
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
                            $('#btn_lanjut_berkas').html('Lanjut');
                            $("#btn_lanjut_berkas").removeAttr("disabled");
                        }

                    },
                    error: function(data) { //jika error tampilkan error pada console
                        console.log('Error:', data);
                        $('#btn_lanjut_berkas').html('Lanjut');
                        $("#btn_lanjut_berkas").removeAttr("disabled");
                    }
                });

            });

            function getDataCatatan(berkas_id) {
                $.get('getDataCatatan/' + berkas_id, function(data) {
                    if (data) {
                        $('#table_catatan_berkas').html(data);
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'error',
                            title: 'Ada masalah'
                        });

                        $('#table_catatan_berkas').html('');
                    }

                });
            }


            $(document).on('click', '.btn_catatan_berkas', function() {
                var berkas_id = $(this).attr('berkas_id');

                $('#berkas_id_catatan').val(berkas_id);

                $('#table_catatan_berkas').html(
                    '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );

                getDataCatatan(berkas_id);

            });


            $(document).on('submit', '#form_tambah_catatan', function(event) {
                event.preventDefault();
                $('#btn_tambah_catatan').attr('disabled', true);
                $('#btn_tambah_catatan').html(
                    '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );
                $.ajax({
                    url: "{{ route('addCatatan') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        // if (data) {


                        // } else {
                        //     Swal.fire({
                        //         toast: true,
                        //         position: 'top-end',
                        //         showConfirmButton: false,
                        //         timer: 3000,
                        //         icon: 'error',
                        //         title: 'Ada masalah'
                        //     });
                        //     $('#btn_tambah_catatan').html(
                        //         '<i class="fas fa-plus-circle"></i> Tambah');
                        //     $("#btn_tambah_catatan").removeAttr("disabled");

                        //     console.log('Error:', data);

                        // }

                        var berkas_id_catatan = $('#berkas_id_catatan').val();
                        getDataCatatan(berkas_id_catatan);
                        $("#btn_tambah_catatan").removeAttr("disabled");
                        $('#btn_tambah_catatan').html(
                            '<i class="fas fa-plus-circle"></i> Tambah'); //tombol simpan

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Data berhasil dibuat'
                        });

                    },
                    error: function(data) { //jika error tampilkan error pada console
                        console.log('Error:', data);
                        $('#btn_tambah_catatan').html(
                            '<i class="fas fa-plus-circle"></i> Tambah');
                        $("#btn_tambah_catatan").removeAttr("disabled");
                    }
                });

            });

            $(document).on('click', '.delete_catatan', function() {

                if (confirm('Apakah anda yakin ingin menghapus data peta?')) {
                    var catatan_id = $(this).attr('catatan_id');

                    $.get('hapusCatatan/' + catatan_id, function(data) {
                        if (data) {
                            var berkas_id_catatan = $('#berkas_id_catatan').val();
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'success',
                                title: 'Data berhasil dihapus'
                            });
                            getDataCatatan(berkas_id_catatan);
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                icon: 'error',
                                title: 'Ada masalah'
                            });

                            $('#table_catatan_berkas').html('');
                        }

                    });
                }



            });


            $(document).on('click', '.btn_kembali_berkas', function() {
                var berkas_id = $(this).attr('berkas_id');
                var proses_id = $(this).attr('proses_id');

                $('#table_kembali_berkas').html(
                    '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );

                $.get('getKembaliBerkas/' + berkas_id + '/' + proses_id, function(data) {
                    if (data) {
                        $('#table_kembali_berkas').html(data);
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'error',
                            title: 'Ada masalah'
                        });

                        $('#table_kembali_berkas').html('');
                    }

                });
            });

            $(document).on('click', '.btn-kembali-berkas', function() {
                var berkas_id = $(this).attr('berkas_id');
                var proses_id = $(this).attr('proses_id');

                $('.btn-kembali-berkas').html(
                    '<div class="spinner-border text-secondary" role="status"><span class="sr-only">Loading...</span></div>'
                );

                $.get('kembaliBerkas/' + berkas_id + '/' + proses_id, function(data) {
                    if (data) {
                        $('#modal_kembali_berkas').modal('hide'); //modal hide

                        var oTable = $('#table_berkas').dataTable(); //inialisasi datatable
                        oTable.fnDraw(false); //reset datatable

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Berhasil mengembalikan berkas'
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

                        $('.btn-kembali-berkas').html('');
                    }

                });
            });


            $(document).on('click', '.btn_history_berkas', function() {
                var berkas_id = $(this).attr('berkas_id');

                $('#table_history_berkas').html(
                    '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );

                $.get('historyBerkas/' + berkas_id, function(data) {
                    if (data) {
                        $('#table_history_berkas').html(data);
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'error',
                            title: 'Ada masalah'
                        });

                        $('#table_history_berkas').html('');
                    }

                });
            });


        });
    </script>
@endsection
@endsection
