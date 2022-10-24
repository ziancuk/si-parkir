@extends('layouts.app')
<title>Master User - Indomaret Parking</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Master User</h6>
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
                            <a class="nav-link active" aria-current="page" href="/master/user">Master User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/master/karyawan">Master Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/master/non-karyawan">Master Non Karyawan</a>
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
                    <div class="col-lg p-0 mb-4 text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employeeModal">Tambah User <i class="fas fa-plus"></i></button>
                    </div>
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{$error}} <br>
                        @endforeach
                    </div>
                    @endif

                    @if (session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name" style="font-size:15px">NIK Karyawan</th>
                                    <th scope="col" class="sort" data-sort="name" style="font-size:15px">Nama User</th>
                                    <th scope="col" class="sort" data-sort="name" style="font-size:15px">Role</th>
                                    <th scope="col" class="sort" data-sort="completion" style="font-size:15px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($petugas as $p)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="status">{{$p->nik}}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        <span class="name mb-0 text-sm">
                                            <span class="name mb-0 text-sm">
                                                {{$p->nama_user}}
                                            </span>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="name mb-0 text-sm">
                                            @if($p->role == '1')
                                            <span class="status">Admin</span>
                                            @else
                                            <span class="status">User</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <form action="/delete/{{$p->user_id}}/user" method="POST">
                                            @csrf
                                            @method("delete")
                                            <a href="/edit/{{$p->user_id}}/user" class="btn btn-primary btn-sm" style="background-color:#2962FF;">
                                                <i class="fas fa-edit" style="color: white;"></i>
                                            </a>
                                            <button type="submit" onclick="return confirm('Anda yakin ingin menghapusnya?')" class="btn btn-danger btn-sm delete-campaign"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5" style="font-size: 18px;">
                                        Belum Ada User
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
                                    {{$petugas->links()}}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD KARYAWAN -->
    <div class=" modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeModal">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/add/user" method="POST" enctype="multipart/form-data" class="ml-2 mr-2" style="margin: auto;">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="nik" placeholder="NIK Karyawan" name="nik">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_user" placeholder="Name Lengkap" name="nama_user">
                        </div>
                        <div class="form-group">
                            <label for="validationTooltip04">Pilih Jenis User</label>
                            <select class="custom-select" name="role" id="validationTooltip04" required>
                                <option value="2">Standar</option>
                                <option value="1">Super</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="Masukkan Kata Sandi" name="password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Masukkan Ulang Kata Sandi" name="password_confirmation">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <input type="submit" class="btn btn-primary" value="Tambah User"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection