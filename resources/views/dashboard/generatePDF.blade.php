<!DOCTYPE html>
<html lang="en">

<head>
    <title>Report - Indomaret Parking</title>
</head>

<body>
    <main>
        <h1>Laporan Parkir</h1>

        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort" data-sort="name" style="font-size:15px">Nomor Polisi</th>
                    <th scope="col" class="sort" data-sort="budget" style="font-size:15px">Kendaraan</th>
                    <th scope="col" class="sort" data-sort="completion" style="font-size:15px">Pengendara</th>
                    <th scope="col" class="sort" data-sort="status" style="font-size:15px">Jam Masuk</th>
                    <th scope="col" class="sort" data-sort="status" style="font-size:15px">Jam Keluar</th>
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

    </main>



</body>

</html>