@extends('template.master')
@section('chart')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"
        integrity="sha512-tMabqarPtykgDtdtSqCL3uLVM0gS1ZkUAVhRFu1vSEFgvB73niFQWJuvviDyBGBH22Lcau4rHB5p2K2T0Xvr6Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
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


                <div class="row justify-content-center">

                    <div class="col-12 mb-4 order-0">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-start">Grafik Performa Penyelesaian Tunggakan</h5>

                            </div>

                            <div class="card-body ">

                                <canvas id="performa" width="400" height="180" class="bg-light"></canvas>

                            </div>

                        </div>


                    </div>
                    <div class="col-12 mb-4 order-0">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-start">Tabel Performa Penyelesaian Tunggakan</h5>

                            </div>

                            <div class="card-body ">

                                <div class="table-responsive">
                                    <table class="table table-sm text-center table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><b>Tanggal</b></td>
                                                @foreach ($data_periode as $d)
                                                    <td>{{ $d }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td><b>Masuk</b></td>
                                                @foreach ($dat_berkas_masuk as $d)
                                                    <td>{{ $d }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td><b>Selesai</b></td>
                                                @foreach ($dat_berkas_selesai as $d)
                                                    <td>{{ $d }}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>


                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-start">Persentase Pengelesaian Tunggakan</h5>

                            </div>

                            <div class="card-body ">

                                <canvas id="persentase" width="300" height="300" class="bg-light"></canvas>

                            </div>

                        </div>
                    </div>

                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-start">Laporan Petugas Ukur</h5>

                            </div>

                            <div class="card-body ">

                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>TAB</th>
                                            <th>Selesai</th>
                                            <th>Tutup</th>
                                            <th>Sisa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($laporanPU as $d)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $d['nm_petugas'] }}</td>
                                                <td>{{ $d['ttl_berkas'] }}</td>
                                                <td>{{ $d['ttl_selesai'] }}</td>
                                                <td>{{ $d['ttl_tutup'] }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>

                    <!-- Total Revenue -->

                    <!--/ Total Revenue -->

                </div>

            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@section('script')
    <script>
        var cData = JSON.parse(`<?php echo $chart; ?>`);
        var periode = JSON.parse(`<?php echo $periode; ?>`);
        const ctx = document.getElementById('performa');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: periode,
                datasets: cData
            }
        });

        const dataPersen = {
            labels: [
                'Selesai',
                'Proses'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [{{ $berkas_selesai }}, {{ $berkas_belum }}],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        const ctx2 = document.getElementById('persentase');
        const myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: dataPersen
        });
    </script>


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
