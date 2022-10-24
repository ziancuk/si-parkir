@extends('layouts.app')
<title>Pelanggaran - Indomaret Parking</title>
@section('content')

<!-- Main content -->
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Pelanggaran Parkir</h6>
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
                                                @forelse($parkir as $k)
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
                                    @if($parkir)
                                    <div class="card-footer py-4">
                                        <nav aria-label="...">
                                            <ul class="pagination justify-content-end mb-0">
                                                <p class="text-left">Total Pelanggaran : {{$parkir->total()}}</p>
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
    </div>
</div>
@endsection