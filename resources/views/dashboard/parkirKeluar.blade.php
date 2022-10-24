@extends('layouts.app')
<title>Parkir Masuk Non Karyawan - Indomaret Parking</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Parkir Keluar Karyawan</h6>
                </div>
                <div class="col-lg-6 col-5 text-right text-white">
                    <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/parkir/masuk">Parkir Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/parkir/keluar">Parkir Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/parkir/fault">Pelanggaran</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body" id="content">
                    <div class="row icon-examples">
                        <div class="col-lg">
                            <div class="card-group">
                                <div class="col-lg-6">
                                    <div class="card" style="height: 28rem;">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Scan Kendaraan Keluar</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row justify-content-center align-items-center" id="kamera" style="height: 100%; min-height: 100%;">
                                                    <div id="read" style="width:600px !important"></div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <form action="/post/keluar" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="mt-4" id="hasil"></input>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card" style="height: 28rem;">
                                        <div class=" card-header">
                                            <h5 class="card-title mb-0">Info Kendaraan </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <div id="park" class="row" style="margin-top:50px">
                                                    @if(!$pengendara)
                                                    <div class="col-lg text-center" style="margin-top:90px;">
                                                        <h3>SILAHKAN SCAN QR CODE UNTUK KELUAR PARKIR</h3>
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
        </div>
    </div>
</div>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"> </script>

<script>
    function parkirKeluar(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        // console.log(`Code matched = ${decodedText}`, decodedResult);

        $("#hasil").val(decodedText);

        let id = decodedText

        fetch('/post/keluar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'url': '/post/keluar',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value,
                },
                body: JSON.stringify({
                    'qr_code': id
                })
            })
            .then(response =>
                response.json())
            .then(res => {
                addCard()
                creteElementParking(res)
            })
            .catch(error => {
                swal({
                    type: 'error',
                    title: 'Data tidak ditemukan',
                    icon: 'error',
                    timer: 2000
                })
                const card = document.querySelector("#park")
                card.innerHTML = ""
                const divCol = document.createElement("div")
                divCol.className = "col-lg text-center"
                const h3 = document.createElement("h3")
                h3.appendChild(document.createTextNode("SILAHKAN SCAN QR CODE UNTUK KELUAR PARKIR"))
                divCol.style.marginTop = "90px";
                divCol.appendChild(h3)
                card.appendChild(divCol)
            });
    }

    let scanKeluar = new Html5QrcodeScanner(
        "read", {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        },
        /* verbose= */
        false);

    function addCard() {
        scanKeluar.clear()

        const div = document.querySelector("#kamera")
        const button = document.createElement("button")
        button.innerHTML = "SCAN QR CODE";
        button.id = "hapus"
        button.className = "hapus btn btn-primary text-center"
        button.onclick = function() {
            scanKeluar.render(parkirKeluar, onScanFailure)
            const tombol = document.getElementById("hapus")
            tombol.parentNode.removeChild(hapus)
            return false
        }
        div.appendChild(button)
    }

    function creteElementParking(res) {
        const card = document.querySelector("#park")
        card.innerHTML = ""

        var text = [
            "Nomor Polisi", ": " + res.drive.no_polisi,
            "NIK Karyawan", ": " + res.drive.employee.nik_karyawan,
            "Nama Karyawan", ": " + res.drive.employee.nama_karyawan,
            "Departemen", ": " + res.drive.employee.departemen,
            "Jam Masuk", ": " + res.parkir.jam_masuk,
            "Jam Keluar", ": " + res.date,
        ]
        text.forEach(function(a) {
            const divCol = document.createElement("div")
            divCol.className = "col-lg-6 p-0"
            const p = document.createElement("p")
            p.appendChild(document.createTextNode(a))
            divCol.appendChild(p)
            card.appendChild(divCol)
        })
        swal({
            type: 'success',
            title: 'Scan berhasil',
            icon: 'success',
            timer: 2000
        })
    }
    scanKeluar.render(parkirKeluar, onScanFailure);

    function onScanFailure(error) {

    }
</script>
@endsection