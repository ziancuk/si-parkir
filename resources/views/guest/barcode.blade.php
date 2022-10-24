<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Parking Barcode - Indomaret Parking</title>
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
                            <img src="{{ asset('img/logo.png') }}" style="height: 80px !important;" alt="...">
                            <br>
                            <strong style="font-size: 25px;">Indomaret Parking</strong>
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
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--7 pb-4">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-white border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <h3 class="text-muted">Parking QR Code</h3>
                        </div>
                        <form action="/barcode" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input class="form-control ml-2" placeholder="Masukkan NIK Karyawan" type="text" name="nik_karyawan" value="{{old('nik_karyawan')}}">
                                </div>
                                @error('nik_karyawan')
                                <div class=" mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                    </div>
                                    <input class="form-control ml-2" placeholder="Masukkan Nama Karyawan" type="text" name="nama_karyawan" value="{{old('nama_karyawan')}}">
                                </div>
                                @error('nama_karyawan')
                                <div class=" mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-road"></i></span>
                                    </div>
                                    <input class="form-control ml-2" placeholder="Masukkan Nomor Polisi" type="text" name="no_polisi" value="{{old('no_polisi')}}">
                                </div>
                                @error('no_polisi')
                                <div class=" mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="validationTooltip04">Departemen</label>
                                <select class="custom-select" name="departemen" id="validationTooltip04" required>
                                    <option selected>Pilih Departemen</option>
                                    <option value="ACL Maintenance">ACL Maintenance</option>
                                    <option value="ADM AREA / DBM ADM">ADM AREA / DBM ADM</option>
                                    <option value="Area Operation">Area Operation</option>
                                    <option value="Area Inventory">BIC</option>
                                    <option value="Development">Development</option>
                                    <option value="Distribution Center (DC)">Distribution Center (DC)</option>
                                    <option value="EDP">EDP</option>
                                    <option value="FAD">FAD (Finance, Accounting+Tax, Virtual)</option>
                                    <option value="General Affair (GA)">General Affair (GA)</option>
                                    <option value="HRD">HRD</option>
                                    <option value="License">License</option>
                                    <option value="Location">Location</option>
                                    <option value="Franchising">Franchising</option>
                                    <option value="Project">Project</option>
                                    <option value="Security">Security</option>
                                    <option value="Training Center / Rekrutment">Training Center / Rekrutment</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="validationTooltip04">Jenis Kendaraan</label>
                                <select class="custom-select" name="jenis_kendaraan" id="validationTooltip04" required>
                                    <option selected>Pilih Jenis Kendaraan</option>
                                    <option value="2">Motor</option>
                                    <option value="1">Mobil</option>n>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-2">Dapatkan QR Code</button>
                            </div>
                        </form>
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
                        &copy; 2022 <a href="#" class="font-weight-bold ml-1" target="_blank">Indomaret Group</a>
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