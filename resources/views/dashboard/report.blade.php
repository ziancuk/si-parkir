@extends('layouts.app')
<title>Report - Indomaret Parking</title>
@section('content')

<!-- Main content -->
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Laporan Parkir</h6>
                </div>
                <div class="col-lg-6 col-5 text-right text-white">
                    <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
                </div>
            </div>
            <!-- Card stats -->
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
                <!-- Light table -->
                <div class="card-body">
                    <div class="row icon-examples">
                        <div class="col-lg">
                            @if (session('status'))
                            <div class="alert alert-success mt-3">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="card-group">
                                <div class="col-lg-6">
                                    <div class="card" style="height: 25rem;">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Pilihan Laporan</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container p-0 align-items-center">

                                                <form action="/post/report" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label for="staticName" class="col-form-label p-0">Start Date</label>
                                                            @if(!$kendaraan)
                                                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ date('Y-m-d') }}">
                                                            @else
                                                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $mulai }}">
                                                            @endif
                                                            @error('start_date')
                                                            <div class="mt-1">
                                                                <small class="ml-1" style="color: red;">{{$message}}</small>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class=" col-sm-6">
                                                            <label for="staticName" class="col-form-label p-0">End Date</label>
                                                            @if(!$kendaraan)
                                                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ date('Y-m-d') }}">
                                                            @else
                                                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $akhir }}">
                                                            @endif
                                                            @error('end_date')
                                                            <div class="mt-1">
                                                                <small class="ml-1" style="color: red;">{{$message}}</small>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class=" form-group row">
                                                        <div class="col-sm">
                                                            <label for="validationTooltip04">Pilih Jenis Kendaraan</label>
                                                            <select class="custom-select" name="jenis_kendaraan" id="validationTooltip04" required>
                                                                @if(!$kendaraan)
                                                                <option value="All">Semua Kendaraan</option>
                                                                <option value="1">Mobil</option>
                                                                <option value="2">Motor</option>
                                                                @else
                                                                <option value="All" {{ $mesin == "All" ? 'selected' : ''}}>Semua Kendaraan</option>
                                                                <option value="1" {{ $mesin == 1 ? 'selected' : ''}}>Mobil</option>
                                                                <option value="2" {{ $mesin == 2 ? 'selected' : ''}}>Motor</option>
                                                                @endif
                                                            </select>
                                                            @error('jenis_kendaraan')
                                                            <div class="mt-1">
                                                                <small class="ml-1" style="color: red;">{{$message}}</small>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm">
                                                            <label for="validationTooltip04">Pilih Jenis Pengendara</label>
                                                            <select class="custom-select" name="jenis_pengendara" id="validationTooltip04" required>
                                                                @if(!$kendaraan)
                                                                <option value="All">Semua Pengendara</option>
                                                                <option value="1">Karyawan</option>
                                                                <option value="2">Non Karyawan</option>
                                                                @else
                                                                <option value="All" {{ $orang == "All" ? 'selected' : ''}}>Semua Pengendara</option>
                                                                <option value="1" {{ $orang == 1 ? 'selected' : ''}}>Karyawan</option>
                                                                <option value="2" {{ $orang == 2 ? 'selected' : ''}}>Non Karyawan</option>
                                                                @endif
                                                            </select>
                                                            @error('jenis_pengendara')
                                                            <div class="mt-1">
                                                                <small class="ml-1" style="color: red;">{{$message}}</small>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row text-center mt-4">
                                                        <div class="col-sm">
                                                            <button type="submit" class="btn btn-primary col-lg" name="button" value="submit">Submit</button>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card" style="height: 25rem;">
                                        <div class=" card-header">
                                            <h5 class="card-title mb-0">Resume Laporan</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row" style="margin-top:-15px">
                                                    @if(!$kendaraan)
                                                    <div class="col-lg text-center" style="margin-top:130px;">
                                                        <h3>Silahkan Submit Untuk Mencetak Laporan</h3>
                                                    </div>
                                                    @else
                                                    <div class="col-lg-12 text-left ">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item font-weight-bold">Total Kendaraan : {{$countKendaraan}}</li>
                                                            <li class="list-group-item font-weight-bold">Total Mobil : {{$countMobil}}</li>
                                                            <li class="list-group-item font-weight-bold">Total Motor : {{$countMotor}}</li>
                                                            <li class="list-group-item font-weight-bold">Total Karyawan : {{$countKaryawan}}</li>
                                                            <li class="list-group-item font-weight-bold">Total Non Karyawan : {{$countNon}}</li>
                                                            <li class="list-group-item font-weight-bold"></li>
                                                        </ul>
                                                        <div class="form-group row text-center mt-1">
                                                            <div class="col-lg-6 text-center">
                                                                <button type="submit" class="btn btn-secondary col-lg" name="button" value="pdf">Download PDF</button>
                                                            </div>
                                                            <div class="col-lg-6 text-center">
                                                                <button type="submit" class="btn btn-success col-lg" name="button" value="csv">Download CSV</button>
                                                            </div>
                                                        </div>

                                                        </form>
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
            <div class="row icon-examples">
                <div class="col-lg">
                    @if(!$kendaraan)
                    @else
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name" style="font-size:15px">Nomor Polisi</th>
                                            <th scope="col" class="sort" data-sort="budget" style="font-size:15px">Kendaraan</th>
                                            <th scope="col" class="sort" data-sort="completion" style="font-size:15px">Pengendara</th>
                                            <th scope="col" class="sort" data-sort="status" style="font-size:15px">Jam Masuk</th>
                                            <th scope="col" class="sort" data-sort="status" style="font-size:15px">Jam Keluar</th>
                                            <th scope="col" class="sort" data-sort="completion" style="font-size:15px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @forelse($kendaraan as $k)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        @if($k->no_polisi)
                                                        <span class="name mb-0 text-sm">{{$k->no_polisi}}</span>
                                                        @else
                                                        <span class="name mb-0 text-sm">{{$k->driver->no_polisi}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </th>
                                            @if( $k->driver->jenis_kendaraan == '1')
                                            <td class="budget">
                                                Mobil
                                            </td>
                                            @elseif( $k->driver->jenis_kendaraan == '2')
                                            <td class="budget">
                                                Motor
                                            </td>
                                            @endif
                                            @if( $k->driver->pengendara == '1')
                                            <td class="budget">
                                                Karyawan
                                            </td>
                                            @elseif( $k->driver->pengendara == '2')
                                            <td class="budget">
                                                Non Karyawan
                                            </td>
                                            @endif
                                            <td>
                                                <span class="name mb-0 text-sm">
                                                    <span class="status">{{$k->jam_masuk}}</span>
                                                </span>
                                            </td>
                                            @if($k->jam_keluar)
                                            <td>
                                                <span class="name mb-0 text-sm">
                                                    <span class="status">{{$k->jam_keluar}}</span>
                                                </span>
                                            </td>
                                            @else
                                            <td>
                                                <span class="name mb-0 text-sm">
                                                    <span class="status">Belum Keluar</span>
                                                </span>
                                            </td>
                                            @endif
                                            <td>
                                                <a href="/detail/{{$k->kode_parkir}}" class="btn btn-primary btn-sm mt-2">
                                                    <i class="fas fa-eye" style="color: white;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center p-5" style="font-size: 18px;">
                                                Belum Ada Kendaraan
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @endif
                            @if($kendaraan)
                            <div class="card-footer py-4">
                                <nav aria-label="...">
                                    <ul class="pagination justify-content-end mb-0">
                                        <p class="text-left">Total Data : {{$kendaraan->total()}}</p>
                                    </ul>
                                </nav>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection