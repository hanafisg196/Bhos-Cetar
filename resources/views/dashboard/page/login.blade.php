<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bhos Cetar</title>
    <link rel="shortcut icon" href="/dist/assets/compiled/png/logotanahdatar.png" type="image/x-icon">
    <link rel="stylesheet" href="/dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/dist/assets/compiled/css/auth.css">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div class="d-flex justify-content-center mt-3">
                    <img src="/dist/assets/compiled/png/logotanahdatar.png" alt="" style="width: 10%;">
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <h4>BHOS CETAR</h4>
                </div>
                <div class="d-flex justify-content-center">
                    <h6>Sistem Informasi Layanan Hukum</h6>
                </div>
                <div id="auth-left" class="mb-3">
                    @if (session()->has('error'))
                        <div class="row">
                            <div class="alert alert-danger col-sm-12" role="alert" style="margin-top: 15px;">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('doLogin') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Nip" name="username" id="username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" id="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Masuk</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" class="text-center">
                    {{-- <img src="/dist/assets/compiled/png/back2.png" alt="login background" style="width: 65%; margin: 0 auto; display: block;"> --}}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
