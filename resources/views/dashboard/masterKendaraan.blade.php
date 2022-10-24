@extends('layouts.app')
<title>Master Kendaraan - Indomaret Parking</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Master Kendaraan</h6>
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
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="/master/kendaraan">Master Kendaraan</a>
                        </li>
                        <!-- if(Auth::user()->role == 'admin') -->
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/master/user">Master User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/master/user">Master Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/master/blok">Master Blok</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/master/fault">Master Pelanggaran</a>
                        </li>
                        <!-- endif -->
                    </ul>
                </div>
                <!-- Light table -->
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="col-lg-3 ml-auto p-0 mb-2">
                        <form action="/kendaraan/cari">
                            <div class="row p-0">
                                <div class="col-lg-9 mr-2 p-0">
                                    <input type="text" class="form-control" placeholder="Cari disini" style="height:31px" name="cari">
                                </div>
                                <div class="col-lg mr-2 p-0">
                                    <input type="submit" class="btn btn-primary btn-sm px-2" value="Cari">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name" style="font-size:15px">Nomor Polisi</th>
                                    <th scope="col" class="sort" data-sort="budget" style="font-size:15px">Jenis Kendaraan</th>
                                    <th scope="col" class="sort" data-sort="status" style="font-size:15px">Jam Masuk</th>
                                    <th scope="col" class="sort" data-sort="status" style="font-size:15px">Jam Keluar</th>
                                    <th scope="col" class="sort" data-sort="completion" style="font-size:15px">Status</th>
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
                                    @if($k->jam_keluar)
                                    <td>
                                        <span class="name mb-0 text-sm">
                                            <span class="status">{{$k->status}}</span>
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
                                        <form action="/delete/{{$k->kode_parkir}}/kendaraan" method="POST">
                                            @csrf
                                            @method("delete")
                                            <a href="/detail/{{$k->kode_parkir}}" class="btn btn-primary btn-sm mt-2">
                                                <i class="fas fa-eye" style="color: white;"></i>
                                            </a>
                                            <!-- if(Auth::user()->role == 'admin') -->
                                            <button type="submit" onclick="return confirm('Anda yakin ingin menghapusnya?')" class="btn btn-danger btn-sm delete-campaign mt-2"><i class="fa fa-trash"></i></button>
                                            <!-- endif -->
                                        </form>
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

                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{$kendaraan->links()}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection