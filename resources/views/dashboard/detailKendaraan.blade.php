@extends('layouts.app')
<title>Detail Kendaraan - Indomaret Parking</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Detail kendaraan</h6>
                </div>
                <div class="col-lg-6 col-5 text-right text-white">
                    <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h5 class="mt-1">Kode Parkir : {{$getParkir->kode_parkir}}</h5>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item font-weight-bold">Nomor Polisi</li>
                            <li class="list-group-item font-weight-bold">Jenis Kendaraan</li>
                            <li class="list-group-item font-weight-bold">Jam Masuk</li>
                            <li class="list-group-item font-weight-bold">Jam Keluar</li>
                            <li class="list-group-item font-weight-bold">Status</li>
                            <li class="list-group-item font-weight-bold">Karyawan yang Bertugas</li>
                            <li class="list-group-item font-weight-bold">Pelanggaran</li>
                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$driver->no_polisi}}</li>
                            @if ($driver->jenis_kendaraan == '1')
                            <li class="list-group-item">Mobil</li>
                            @elseif ( $driver->jenis_kendaraan == '2')
                            <li class="list-group-item">Motor</li>
                            @endif
                            <li class="list-group-item">{{$getParkir->jam_masuk}}</li>
                            @if($getParkir->jam_keluar)
                            <li class="list-group-item">{{$getParkir->jam_keluar}}</li>
                            @else
                            <li class="list-group-item">Belum Keluar</li>
                            @endif
                            <li class="list-group-item">{{$getParkir->status}}</li>
                            <li class="list-group-item">{{$getParkir->user->nama_user}}</li>
                            @if($getParkir->status == 'Fault')
                            <li class="list-group-item">{{$getParkir->fault->nama_pelanggaran}}</li>
                            @else
                            <li class="list-group-item">Tidak Melakakukan Pelanggaran</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg p-4 text-right">
                    <form action="/delete/{{$getParkir->kode_parkir}}/kendaraan" method="POST">
                        @csrf
                        @method("delete")
                        @if(Auth::user()->role == '1')
                        <button type="submit" onclick="return confirm('Anda yakin ingin menghapusnya?')" class="btn btn-danger delete-campaign">Hapus</button>
                        @endif
                        <form>
                            <input type="button" class="btn btn-primary text-right" value="Kembali" onclick="history.back()"></input>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection