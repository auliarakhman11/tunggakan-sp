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
                        <h4><b>Dashboard</b></h4>
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

                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="float-left"><b>Data Scan Peta</b></h4>
                            </div>
                            <div class="card-body">
                                <h5><b>Jumlah Upload ({{ $jml_data_scan }})</b></h5>
                                <a href="{{ route('peta') }}" class="btn btn-primary"><i class="fas fa-box"></i> Lihat</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="float-left"><b>Data Digital</b></h4>
                            </div>
                            <div class="card-body row">
                                <div class="col-6">
                                    <h5><b>Sudah Sesuai Posisi ({{ $jml_data_sesuai }})</b></h5>
                                    <a href="{{ route('petaSesuai') }}" class="btn btn-primary"><i class="fas fa-box"></i>
                                        Lihat</a>
                                </div>

                                <div class="col-6">
                                    <h5><b>Belum Terdudukan ({{ $jml_data_tidak }})</b></h5>
                                    <a href="{{ route('petaBelum') }}" class="btn btn-primary"><i class="fas fa-box"></i>
                                        Lihat</a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="float-left"><b>Catatan</b></h4>
                            </div>
                            <div class="card-body">
                                <h5><b>Jumlah Catatan ({{ $jml_catatan }})</b></h5>
                                <a href="{{ route('catatan') }}" class="btn btn-primary"><i class="fas fa-box"></i>
                                    Lihat</a>
                            </div>
                        </div>
                    </div>

                    @if (Auth::user()->role_id == 1)
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="float-left"><b>Admin</b></h4>
                                </div>
                                <div class="card-body">
                                    <h5><b>User</b></h5>
                                    <a href="{{ route('user') }}" class="btn btn-primary"><i class="fas fa-box"></i>
                                        Lihat</a>
                                </div>
                            </div>
                        </div>
                    @endif



                </div>

            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->





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

        });
    </script>
@endsection
@endsection
