@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Data Petugas</h4>
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
                <div class="row justify-content-center">

                    <div class="col-12 col-md-10">
                        <div class="card">
                            {{-- @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  @endif --}}
                            <div class="card-header">
                                <h5 class="float-left">Data Petugas</h5>
                                <button type="button" id="btn-add-petugas" class="btn btn-sm btn-primary float-right"
                                    data-toggle="modal" data-target="#modal-add-petugas">
                                    <i class="fas fa-plus-circle"></i>
                                    Tambah Petugas
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm" id="table_petugas">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Petugas</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
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

    <!-- Modal -->
    <form id="form-add-petugas">
        <div class="modal fade" id="modal-add-petugas" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Nama Petugas</label>
                                    <input type="text" class="form-control" name="nm_petugas" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-input-petugas">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="form-edit-petugas">
        <div class="modal fade" id="modal-edit-petugas" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" id="id_petugas_e">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Nama Petugas</label>
                                    <input type="text" class="form-control" id="nm_petugas_e" name="nm_petugas" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-edit-petugas">Edit</button>
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

            //petugas
            function getListKecamatan() {
                $.get('get-list-kecamatan', function(data) {
                    $('#dt_kecamatan').html(data);
                });
            }

            $('#table_petugas').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "{{ route('getDataPetugas') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nm_petugas',
                        name: 'nm_petugas'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                order: [
                    [0, 'asc']
                ]
            });

            $(document).on('submit', '#form-add-petugas', function(event) {
                event.preventDefault();
                $('#btn-input-petugas').attr('disabled', true);
                $('#btn-input-petugas').html('Loading..');
                $.ajax({
                    url: "{{ route('addPetugas') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        if (data) {
                            $('#form-add-petugas').trigger("reset"); //form reset
                            $('#modal-add-petugas').modal('hide'); //modal hide
                            $("#btn-input-petugas").removeAttr("disabled");
                            $('#btn-input-petugas').html('Tambah'); //tombol simpan

                            var oTable = $('#table_petugas')
                                .dataTable(); //inialisasi datatable
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
                                title: 'Nama petugas sudah ada'
                            });
                            $('#btn-input-petugas').html('Tambah');
                            $("#btn-input-petugas").removeAttr("disabled");
                        }

                    },
                    error: function(data) { //jika error tampilkan error pada console
                        alert('Error:', data);
                        $('#btn-input-petugas').html('Tambah');
                        $("#btn-input-petugas").removeAttr("disabled");
                    }
                });

            });

            $(document).on('click', '.edit_petugas', function() {
                var id = $(this).data('id');

                $.get('getPetugas/' + id, function(data) {
                    //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                    $('#id_petugas_e').val(data.id);
                    $('#nm_petugas_e').val(data.nm_petugas);
                });
            });

            $(document).on('submit', '#form-edit-petugas', function(event) {
                event.preventDefault();
                $('#btn-edit-petugas').attr('disabled', true);
                $('#btn-edit-petugas').html('Loading..');
                $.ajax({
                    url: "{{ route('editPetugas') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        $('#form-edit-petugas').trigger("reset"); //form reset
                        $('#modal-edit-petugas').modal('hide'); //modal hide
                        $("#btn-edit-petugas").removeAttr("disabled");
                        $('#btn-edit-petugas').html('Edit'); //tombol simpan

                        var oTable = $('#table_petugas').dataTable(); //inialisasi datatable
                        oTable.fnDraw(false); //reset datatable

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: 'Data berhasil diedit'
                        });


                    },
                    error: function(data) { //jika error tampilkan error pada console
                        alert('Error:', data);
                        $('#btn-edit-petugas').html('Edit');
                        $("#btn-edit-petugas").removeAttr("disabled");
                    }
                });

            });

            //end petugas

        });
    </script>
@endsection
@endsection
