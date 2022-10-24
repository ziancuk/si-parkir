<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Register - Indomaret Parking</title>
    {{-- Styles --}}
    @stack('before-style')
    @include('includes.style')
    @stack('after-style')
</head>

<body class="bg-default">
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-3 ">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg text-white">
                            <i class="fas fa-parking fa-4x"></i>
                            <br>
                            <strong style="font-size: 25px;">SI PARKIR</strong>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5 text-white">
                            <p style="font-size: 10px;"><span id="tanggal"></span> ; <span id="watch"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--7 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="card bg-white border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <h4 class="text-muted">Registrasi User</h4>
                            </div>
                            @if (session('status'))
                            <div class="alert alert-danger mt-3">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form action="/register" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="ml-2 form-control" placeholder=" Nama Lengkap" type="text" name="name" value="{{old('name')}}">
                                    </div>
                                    @error('name')
                                    <div class="mt-1">
                                        <small class="ml-1" style="color: red;">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="ml-2 form-control" placeholder=" NIK Karyawan" type="text" name="nik_karyawan" value="{{old('nik_karyawan')}}">
                                    </div>
                                    @error('username')
                                    <div class="mt-1">
                                        <small class="ml-1" style="color: red;">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input class="ml-2 form-control" placeholder=" Kode Rahasia Registrasi" type="password" name="code" value="{{old('code')}}">
                                    </div>
                                    @error('code')
                                    <div class="mt-1">
                                        <small class="ml-1" style="color: red;">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input class="ml-2 form-control" placeholder=" Masukkan Kata Sandi" type="password" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input class="ml-2 form-control" placeholder=" Masukkan Kata Sandi yang sama" type="password" name="password_confirmation">
                                    </div>
                                    @error('password')
                                    <div class="mt-1">
                                        <small class="ml-1" style="color: red;">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg text-left">
                                        <a href="/" class="text-primary"><small>Sudah punya akun? Klik disini</small></a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-2">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-2">
        <div class=" container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl">
                    <div class="copyright text-center text-muted">
                        &copy; 2022 <a href="#" class="font-weight-bold ml-1" target="_blank">Fauzian Sebastian</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    {{-- Script --}}
    @include('includes.script')
    @stack('after-script')

</body>

</html>