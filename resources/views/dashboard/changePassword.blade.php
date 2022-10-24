@extends('layouts.app')
<title>Ubah - Kata Sandi</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Ubah Kata Sandi</h6>
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
                    <h5 class="mt-1">{{Auth::user()->name}}</h5>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="/profil/{{Auth::user()->user_id}}/update" method="POST" enctype="multipart/form-data" class="ml-2 mr-2" style="margin: auto;">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label for="staticPassword" class="col-sm-2 col-form-label">Kata Sandi Baru</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi Baru">
                                <input type="password" class="form-control mt-3" id="password_confirmation" placeholder="Masukkan Ulang Kata Sandi" name="password_confirmation">
                                @error('password')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg text-right p-0">
                            <a href="/dashboard" type="button" class="btn btn-secondary">Batal</a>
                            <input type="submit" class="btn btn-primary" value="Ubah"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection