@extends('layouts.app')
<title>Parkir Masuk Non Karyawan - Indomaret Parking</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Parkir Masuk Non Karyawan</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/parkir/masuk/non-karyawan">Parkir Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/parkir/keluar/non-karyawan">Parkir Keluar</a>
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
                                    <div class="card" style="height: 33rem;">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Input Kendaraan Masuk</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container align-items-center">
                                                <form class="mt-5" action="/parkir/masuk/non-karyawan" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="tanggal" class="col-sm-4 col-form-label">Tanggal / Jam</label>
                                                        <div class="col-sm-8">
                                                            <p class="text-muted mt-2"><span id="tanggal"></span> ; <span id="watch"></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <label for="nomor" class="col-sm-4 col-form-label" style="font-size:13px;">Nomor Polisi</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="no_polisi" name="no_polisi">
                                                            @error('no_polisi')
                                                            <div class="mt-1">
                                                                <small class="ml-1" style="color: red;">{{$message}}</small>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <legend class="col-form-label col-sm-4 float-sm-left" style="font-size:13px;">Jenis Pengendara</legend>
                                                        <div class="col-sm-8">
                                                            <select class="custom-select" name="tipe_pengendara" id="validationTooltip04" required>
                                                                <option value="PELAMAR">Pelamar</option>
                                                                <option value="SUPPLIER">Supplier</option>
                                                                <option value="TAMU">Tamu</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <fieldset class="form-group row">
                                                        <legend class="col-form-label col-sm-4 float-sm-left" style="font-size:13px;">Jenis Kendaraan</legend>
                                                        <div class="col-sm-8">
                                                            <select class="custom-select" name="jenis_kendaraan" id="validationTooltip04" required>
                                                                <option selected>Pilih Jenis Kendaraan</option>
                                                                <option value="2">Motor</option>
                                                                <option value="1">Mobil</option>n>
                                                            </select>
                                                        </div>
                                                    </fieldset>

                                                    <div class="form-group row text-right">
                                                        <div class="col-sm mt-4">
                                                            <button type="submit" class="col-sm btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card" style="height: 33rem;">
                                        <div class=" card-header">
                                            <h5 class="card-title mb-0">Tiket parkir</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($parkir == 'nok')
                                            <div class="col-lg text-center" style="margin-top:151px;">
                                                <h3>NOMOR POLISI KENDARAAN SUDAH MASUK TEMPAT PARKIR DAN BELUM KELUAR</h3>
                                            </div>
                                            @elseif($parkir)
                                            <div class="container text-center p-0" style="margin-top:20px;">
                                                <h5>TIKET PARKIR</h5>
                                                <h5 style="margin-top:-9px !important">PT INDOMARCO PRISMATAMA BOGOR 1</h5>
                                                <br>
                                                <p style="margin-top: -9px;">Jl. Alternatif Sentul Km.46, Cijujung, Kec. Sukaraja, Kab. Bogor, Jawa Barat 16710.</p>
                                                <p class="mt-1">{{$date}}</p>
                                                <p class="mt-3"><b> Lokasi Parkir : Blok D</b></p>
                                                <h5 style="margin-top: -6px;">KODE PARKIR : </h5>
                                                <p style="margin-top: -9px;font-size:30px;">{{$kode_parkir}}</p>
                                                <p class="mt-2" style="font-size:11px;">1. KERUSAKAN & KEHILANGAN BARANG DALAM KENDARAAN JADI TANGGUNG JAWAB PEMILIK (TIDAK ADA PENGGANTIAN) <br>
                                                    2. JIKA TIKET PARKIR HILANG, MAKA WAJIB MENUNJUKKAN STNK DAN TERKENA DENDA SEBESAR Rp. 20.000 <br>
                                                    3. BERLAKU 1X (SATU KALI) PARKIR</p>
                                            </div>
                                            @else
                                            <div class="col-lg text-center" style="margin-top:150px;">
                                                <h3>SILAHKAN INPUT KENDARAAN MASUK UNTUK MENDAPATKAN TIKET PARKIR</h3>
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


@endsection