@extends('layouts.app')
<title>Dashboard - Indomaret Parking</title>
@section('content')

<!-- Main content -->
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Dashboard</h6>
                </div>
                <div class="col-lg-6 col-5 text-right text-white">
                    <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
                </div>
            </div>
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-title text-uppercase text-muted mb-0">Total Kendaraan</h6>
                                    <span class="h2 font-weight-bold mb-0">{{$total}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="fas fa-car-side"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-title text-uppercase text-muted mb-0">Mobil</h6>
                                    <span class="h2 font-weight-bold mb-0">{{$mobil}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="fas fa-car"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-title text-uppercase text-muted mb-0">Motor</h6>
                                    <span class="h2 font-weight-bold mb-0">{{$motor}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="fas fa-motorcycle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Resume Blok -->
            <div class="row">
                @forelse($area as $a)
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-title text-uppercase text-muted mb-0">{{$a->nama_blok}}</h6>
                                    @if($a->nama_blok == "Blok A")
                                    <span class="h2 font-weight-bold mb-0">{{$blokA}}</span>
                                    @elseif($a->nama_blok == "Blok B")
                                    <span class="h2 font-weight-bold mb-0">{{$blokB}}</span>
                                    @elseif($a->nama_blok == "Blok C")
                                    <span class="h2 font-weight-bold mb-0">{{$blokC}}</span>
                                    @elseif($a->nama_blok == "Blok D")
                                    <span class="h2 font-weight-bold mb-0">{{$blokD}}</span>
                                    @endif
                                </div>
                                <div class="col-auto">
                                    @if($a->nama_blok == "Blok A")
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        @elseif($a->nama_blok == "Blok B")
                                        <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                            @elseif($a->nama_blok == "Blok C")
                                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                                @elseif($a->nama_blok == "Blok D")
                                                <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                                    @endif
                                                    <h6 class="card-title text-uppercase text-white mb-0">{{$a->kapasitas}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            @endforelse
                        </div>
                        <!-- End Resume Blok -->
                    </div>
                </div>
            </div>
            <!-- Page content -->
            <div class="container-fluid mt--6">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="mb-0">List Kendaraan Terbaru</h4>
                                    </div>
                                    <div class="col text-right">
                                        <a href="/report" class="btn btn-sm btn-primary">Lihat Semuanya</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name" style="font-size:10px">Nomor Polisi</th>
                                            <th scope="col" class="sort" data-sort="budget" style="font-size:10px">Jenis Kendaraan</th>
                                            <th scope="col" class="sort" data-sort="status" style="font-size:10px">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($master as $m)
                                        <tr>
                                            <th scope="row">
                                                {{$m->driver->no_polisi}}
                                            </th>
                                            @if( $m->driver->jenis_kendaraan == '1')
                                            <td>
                                                Mobil
                                            </td>
                                            @elseif ($m->driver->jenis_kendaraan == '2')
                                            <td>
                                                Motor
                                            </td>
                                            @endif
                                            <td>
                                                {{$m->status}}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center p-5">
                                                Belum ada yang parkir
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="mb-0">Pelanggaran</h4>
                                    </div>
                                    <div class="col text-right">
                                        <a href="/pelanggaran" class="btn btn-sm btn-primary">Lihat</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- Pelanggaran Tiket Parkir Hilang -->
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name" style="font-size:10px">Nomor Polisi</th>
                                            <th scope="col" class="sort" data-sort="budget" style="font-size:10px">Jenis Kendaraan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($fault as $f)
                                        <tr>
                                            <th scope="row">
                                                {{$f->driver->no_polisi}}
                                            </th>
                                            @if( $f->driver->jenis_kendaraan == '1')
                                            <td>
                                                Mobil
                                            </td>
                                            @elseif ($f->driver->jenis_kendaraan == '2')
                                            <td>
                                                Motor
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center p-5">
                                                Tidak ada pelanggaran hari ini
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endsection