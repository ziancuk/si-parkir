@extends('layouts.app')
<title>Edit - Pelanggaran</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Edit Data Pelanggaran</h6>
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
                    <h5 class="mt-1">Data Pelanggaran</h5>
                </div>
                <div class="card-body">
                    <form action="/fault/{{$getFault->fault_id}}/update" method="POST" enctype="multipart/form-data" class="ml-2 mr-2" style="margin: auto;">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-4 col-form-label">Nama Pelanggaran</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_pelanggaran" name="nama_pelanggaran" value="{{old('nama_pelanggaran') ?? $getFault->nama_pelanggaran}}">
                                @error('nama_fault')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticRole" class="col-sm-4 col-form-label">Role Pelanggaran</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="role_pelanggaran " name="role_pelanggaran" value="{{old('role_pelanggaran') ?? $getFault->role_pelanggaran}}">
                                @error('role_pelanggaran')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticRole" class="col-sm-4 col-form-label">Denda</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="denda " name="denda" value="{{old('denda') ?? $getFault->denda}}">
                                @error('denda')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg text-right p-0">
                            <a href="/master/fault" type="button" class="btn btn-secondary">Batal</a>
                            <input type="submit" class="btn btn-primary" value="Edit"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection