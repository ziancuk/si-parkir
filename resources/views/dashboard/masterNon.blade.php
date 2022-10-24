@extends('layouts.app')
<title>Master Non Karyawan - Indomaret Parking</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Master Non Karyawan</h6>
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
                            <a class="nav-link" aria-current="page" href="/master/user">Master User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/master/karyawan">Master Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/master/non-karyawan">Master Non Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/master/blok">Master Blok</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/master/fault">Master Pelanggaran</a>
                        </li>
                    </ul>
                </div>
                <!-- Light table -->
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name" style="font-size:15px">Nomor</th>
                                    <th scope="col" class="sort" data-sort="name" style="font-size:15px">Jenis Pengendara</th>
                                    <th scope="col" class="sort" data-sort="name" style="font-size:15px">Nomor Polisi</th>
                                    <th scope="col" class="sort" data-sort="name" style="font-size:15px">Jenis Kendaraan</th>
                                    <th scope="col" class="sort" data-sort="completion" style="font-size:15px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($non as $k)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">
                                                    {{$loop->iteration}}
                                                </span>
                                            </div>
                                        </div>
                                    </th>
                                    <td scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">
                                                    {{$k->guest->tipe_pengendara}}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="name mb-0 text-sm">
                                            <span class="status">{{$k->no_polisi}}</span>
                                        </span>
                                    </td>
                                    @if($k->jenis_kendaraan == 1)
                                    <td>
                                        <span class="name mb-0 text-sm">
                                            <span class="status">Mobil</span>
                                        </span>
                                    </td>
                                    @elseif($k->jenis_kendaraan == 2)
                                    <td>
                                        <span class="name mb-0 text-sm">
                                            <span class="status">Motor</span>
                                        </span>
                                    </td>
                                    @endif
                                    <td>
                                        <form action="/delete/{{$k->guest->guest_id}}/non" method="POST">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" onclick="return confirm('Anda yakin ingin menghapusnya?')" class="btn btn-danger btn-sm delete-campaign"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5" style="font-size: 18px;">
                                        Belum Ada Karyawan
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item">
                                    {{$non->links()}}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection