<!DOCTYPE html>
<html lang="en">

<head>
    <title>Surat</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('img') }}/Logo_BPN-KemenATR.png" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />

    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>

    <style>
        .ld {
            display: inline-block;
            position: relative;
            width: 21px;
            height: 21px;
        }

        .ld div {
            display: inline-block;
            position: absolute;
            left: 3px;
            width: 6px;
            background: #fff;
            animation: c 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }

        .ld div:nth-child(1) {
            left: 3px;
            animation-delay: -0.24s;
        }

        .ld div:nth-child(2) {
            left: 12px;
            animation-delay: -0.12s;
        }

        .ld div:nth-child(3) {
            left: 21px;
            animation-delay: 0;
        }

        @keyframes c {
            0% {
                top: 3px;
                height: 24px;
            }

            50%,
            100% {
                top: 9px;
                height: 12px;
            }
        }
    </style>
</head>

<body>

    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" id="form_login" action="{{ route('login') }}">
                        @csrf
                        @error('username')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <?php if(session('success')): ?>
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        <?php endif; ?>
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3">Login Surat</p>
                            {{-- <button type="button" class="btn btn-primary btn-floating mx-1">
					<i class="fab fa-facebook-f"></i>
				  </button>
	  
				  <button type="button" class="btn btn-primary btn-floating mx-1">
					<i class="fab fa-twitter"></i>
				  </button>
	  
				  <button type="button" class="btn btn-primary btn-floating mx-1">
					<i class="fab fa-linkedin-in"></i>
				  </button> --}}
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0"></p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Masukan Username" name="username" value="{{ old('username') }}" />
                            <label class="form-label" for="form3Example3">Username</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" name="password" id="form3Example4"
                                class="form-control form-control-lg" placeholder="Masukan Password" />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>

                        {{-- <div class="d-flex justify-content-between align-items-center">
				  <!-- Checkbox -->
				  <div class="form-check mb-0">
					<input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
					<label class="form-check-label" for="form2Example3">
					  Remember me
					</label>
				  </div>
				  <a href="#!" class="text-body">Forgot password?</a>
				</div> --}}

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="btn_login"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            {{-- <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"
					  class="link-danger">Register</a></p> --}}
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright © 2022. Kantor Pertanahan Kabupaten Banjar All rights reserved.
            </div>
            <!-- Copyright -->

            <!-- Right -->
            {{-- <div>
			<a href="#!" class="text-white me-4">
			  <i class="fab fa-facebook-f"></i>
			</a>
			<a href="#!" class="text-white me-4">
			  <i class="fab fa-twitter"></i>
			</a>
			<a href="#!" class="text-white me-4">
			  <i class="fab fa-google"></i>
			</a>
			<a href="#!" class="text-white">
			  <i class="fab fa-linkedin-in"></i>
			</a>
		  </div> --}}
            <!-- Right -->
        </div>
    </section>




    <!--===============================================================================================-->
    <script src="{{ asset('auth') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>

    <script>
        $(document).ready(function() {

            $(document).on('submit', '#form_login', function(event) {
                $('#btn_login').attr('disabled', true);
                $('#btn_login').html('Loading <div class="ld"><div></div><div></div><div></div></div>');


            });

        });
    </script>

</body>

</html>
