@extends('layouts.app')
<title>Edit - Blok</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Edit Data Blok</h6>
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
                    <h5 class="mt-1">Data Blok</h5>
                </div>
                <div class="card-body">
                    <form action="/blok/{{$getBlok->blok_id}}/update" method="POST" enctype="multipart/form-data" class="ml-2 mr-2" style="margin: auto;">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-2 col-form-label">Nama Blok</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_blok" name="nama_blok" value="{{old('nama_blok') ?? $getBlok->nama_blok}}">
                                @error('nama_blok')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticRole" class="col-sm-2 col-form-label">Kapasitas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kapasitas " name="kapasitas" value="{{old('kapasitas') ?? $getBlok->kapasitas}}">
                                @error('kapasitas')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg text-right p-0">
                            <a href="/master/blok" type="button" class="btn btn-secondary">Batal</a>
                            <input type="submit" class="btn btn-primary" value="Edit"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection