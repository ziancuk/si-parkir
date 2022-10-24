@extends('layouts.app')
<title>Parkir Keluar Non Karyawan- Indomaret Parking</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Parkir Keluar Non Karyawan</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/parkir/masuk/non-karyawan">Parkir Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/parkir/keluar/non-karyawan">Parkir Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/parkir/fault">Pelanggaran</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="row icon-examples">
                        <div class="col-lg">
                            <div class="card-group">
                                <div class="col-lg-6">
                                    <div class="card" style="height: 25rem;">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Input Kendaraan Keluar</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <form action="/parkir/keluar/non-karyawan" method="post" enctype="multipart/form-data" style="margin-top: 70px;">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="tanggal" class="col-sm-4 col-form-label" style="font-size:13px;">Jam & Tanggal</label>
                                                        <div class="col-sm-8">
                                                            <p class="text-muted mt-2"><span id="tanggal"></span> ; <span id="watch"></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="nomor" class="col-sm-4 col-form-label" style="font-size:13px;">Kode Parkir</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="kode_parkir" name="kode_parkir">
                                                            @error('kode_parkir')
                                                            <div class="mt-1">
                                                                <small class="ml-1" style="color: red;">{{$message}}</small>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row text-right">
                                                        <div class="col-sm">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card" style="height: 25rem;">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Info parkir</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container p-0">
                                                @if (!$getParkir && !$alert)
                                                <div class="col-lg text-center" style="margin-top:124px;">
                                                    <h4>SILAHKAN SUBMIT KODE PARKIR TERLEBIH DAHULU</h4>
                                                </div>
                                                @elseif ($alert == 'keluar')
                                                <div class="col-lg text-center" style="margin-top:74px;">
                                                    <h3>KODE PARKIR SUDAH EXPIRED (KENDARAAN SUDAH KELUAR PARKIR)</h3>
                                                </div>
                                                @elseif ($alert == 'notCode')
                                                <div class="col-lg text-center" style="margin-top:130px;">
                                                    <h4>KODE TIDAK DITEMUKAN</h4>
                                                </div>
                                                @elseif ($getParkir)
                                                <div class="col-lg text-center" style="margin-top:20px;">
                                                    <h3>KODE PARKIR : {{$getParkir->kode_parkir}}</h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <p class="mt-4">Nomor Polisi</p>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <p class="mt-4">: {{$getParkir->driver->no_polisi}}</p>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: -10px;">
                                                    <div class="col-lg-6">
                                                        <p sty>Jenis Kendaraan</p>
                                                    </div>
                                                    @if($getParkir->driver->jenis_kendaraan == '1')
                                                    <div class="col-lg-6">
                                                        <p>: Mobil</p>
                                                    </div>
                                                    @elseif($getParkir->driver->jenis_kendaraan == '2')
                                                    <div class="col-lg-6">
                                                        <p>: Motor</p>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="row" style="margin-top: -10px;">
                                                    <div class="col-lg-6">
                                                        <p sty>Jam Masuk</p>
                                                    </div>
                                                    <div class=" col-lg-6">
                                                        <p>: {{$getParkir->jam_masuk}}</p>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: -10px;">
                                                    <div class="col-lg-6">
                                                        <p sty>Jam Keluar</p>
                                                    </div>
                                                    <div class=" col-lg-6">
                                                        <p>: {{$getParkir->jam_keluar}}</p>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection