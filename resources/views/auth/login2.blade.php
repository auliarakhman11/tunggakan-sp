<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMANTAN</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('auth') }}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth') }}/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth') }}/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth') }}/css/iofrm-theme4.css">
</head>

<body>
    <div class="form-body">
        <div class="website-logo">
            <a href="">
                <div class="logo">
                    <img class="logo-size" src="{{ asset('img') }}/Logo_BPN-KemenATR.png" alt="">
                </div>
            </a>
        </div>
        <div class="iofrm-layout">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="{{ asset('auth') }}/images/Surveyor2.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>SIMANTAN</h3>
                        <p>Sistem Penyimpanan Peta Pertanahan</p>
                        {{-- <div class="page-links">
                            <a href="login4.html" class="active">Login</a><a href="register4.html">Register</a>
                        </div> --}}

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
                        <form method="POST" id="form_login" action="{{ route('login') }}">
                            @csrf
                            <input class="form-control" type="text" name="username" placeholder="Masukan Username"
                                value="{{ old('username') }}" required>
                            <input class="form-control" type="password" name="password" placeholder="Masukan Password"
                                required>
                            <div class="form-button">
                                <button id="btn_login" type="submit" class="ibtn">Login</button>
                            </div>
                        </form>
                        {{-- <div class="other-links">
                            <span>Or login with</span><a href="#">Facebook</a><a href="#">Google</a><a
                                href="#">Linkedin</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('auth') }}/js/jquery.min.js"></script>
    <script src="{{ asset('auth') }}/js/popper.min.js"></script>
    <script src="{{ asset('auth') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('auth') }}/js/main.js"></script>

    <script>
        $(document).ready(function() {


            $(document).on('submit', '#form_login', function(event) {
                $('#btn_login').attr('disabled', true);
                $('#btn_login').html('Loading..');


            });

        });
    </script>
</body>

</html>
