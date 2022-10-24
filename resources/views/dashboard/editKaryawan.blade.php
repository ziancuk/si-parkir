@extends('layouts.app')
<title>Edit - Karyawan</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Edit Data Karyawan</h6>
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
                    <h5 class="mt-1">Data Karyawan</h5>
                </div>
                <div class="card-body">
                    <form action="/karyawan/{{$getEmployee->driver_id}}/update" method="POST" enctype="multipart/form-data" class="ml-2 mr-2" style="margin: auto;">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-2 col-form-label">NIK Karyawan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nik_karyawan" name="nik_karyawan" value="{{old('nik_karyawan') ?? $getEmployee->nik_karyawan}}">
                                @error('nik_karyawan')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-2 col-form-label">Nama Karyawan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="{{old('nama_karyawan') ?? $getEmployee->employee->nama_karyawan}}">
                                @error('nama_karyawan')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticRole" class="col-sm-2 col-form-label">Nomor Polisi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_polisi " name="no_polisi" value="{{old('no_polisi') ?? $getEmployee->no_polisi}}">
                                @error('no_polisi')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticRole" class="col-sm-2 col-form-label">Departemen</label>
                            <div class="col-sm-10">
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
                                @error('departemen')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticRole" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kendaraan" id="jenis_kendaraan" value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        Mobil
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kendaraan" id="jenis_kendaraan" value="2">
                                    <label class="form-check-label" for="gridRadios2">
                                        Motor
                                    </label>
                                </div>
                                @error('jenis_kendaraan')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg text-right p-0">
                            <a href="/master/karyawan" type="button" class="btn btn-secondary">Batal</a>
                            <input type="submit" class="btn btn-primary" value="Edit"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection