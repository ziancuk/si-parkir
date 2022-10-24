@extends('layouts.app')
<title>My Profile - Indomaret Parking</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">My Profile</h6>
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
                    <h5 class="mt-1">Data Pribadi</h5>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item font-weight-bold">NIK User</li>
                            <li class="list-group-item font-weight-bold">Nama Lengkap</li>
                            <li class="list-group-item font-weight-bold">Role</li>
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{Auth::user()->nik}}</li>
                            <li class="list-group-item">{{Auth::user()->nama_user}}</li>
                            <li class="list-group-item">{{Auth::user()->role}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg p-4 text-right">
                    <a href="/dashboard" class="btn btn-primary text-right">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection