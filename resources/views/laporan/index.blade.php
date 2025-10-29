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

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-start">Laporan Petugas Ukur</h5>
                                <div class="row mt-4">
                                    <div class="col-9">
                                        <div class="row justify-content-end">
                                            @foreach ($petugas as $p)
                                                <div class="col-3" style="font-size: 13px;">
                                                    <label for="petugas{{ $p->id }}"><input class="petugas_id" id="petugas{{ $p->id }}" type="checkbox" value="{{ $p->id }}" name="petugas_id" checked> {{ $p->nm_petugas }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <input type="number" class="form-control form-control-sm" name="tahun" id="tahun" placeholder="Tahun" value="2025" required>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-sm btn-primary float-end" id="btn_getLaporanPetugasUkur"><i class="fas fa-search"></i> Cari</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="table_laporan_pu">

                                

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

            // $(document).on('submit', '#form_laporan_pu', function(event) {
            //     event.preventDefault();
            //     // $('#btn_tambah_berkas').attr('disabled', true);
            //     $('#table_laporan_pu').html(
            //         '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
            //     );
            //     $.ajax({
            //         url: "{{ route('getLaporanPetugasUkur') }}",
            //         method: 'GET',
            //         data: new FormData(this),
            //         // contentType: false,
            //         // processData: false,
            //         success: function(data) {

            //             $('#table_laporan_pu').html(data);

            //         },
            //         error: function(data) { //jika error tampilkan error pada console
            //             console.log('Error:', data);

            //             $('#table_laporan_pu').html('');
            //         }
            //     });

            // });
            

            $(document).on('click', '#btn_getLaporanPetugasUkur', function() {
                var tahun = $('#tahun').val();

                let petugas_id = [];
                $('input[name="petugas_id"]:checked').each(function(index, element) {

                    petugas_id.push($(this).val());
                });

                getLaporanPetugasUkur(petugas_id, tahun);
                // console.log(petugas_id);
            });

            

            function getLaporanPetugasUkur(petugas_id = [], tahun = '2025') {
                $('#table_laporan_pu').html(
                    'Loading... <div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                );


                $.ajax({
                    url: "{{ route('getLaporanPetugasUkur') }}",
                    method: "GET",
                    data: {
                        petugas_id: petugas_id,
                        tahun: tahun
                    },
                    success: function(data) {
                        $('#table_laporan_pu').html(data);


                    }

                });
            }

            var dt_tahun = $('#tahun').val();
            let dt_petugas_id = [];
                $('input[name="petugas_id"]:checked').each(function(index, element) {

                    dt_petugas_id.push($(this).val());
                });
            getLaporanPetugasUkur(dt_petugas_id, dt_tahun);

        });
    </script>
@endsection
@endsection
