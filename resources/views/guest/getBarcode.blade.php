<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Barcode - Indomaret Parking</title>
    {{-- Styles --}}
    @stack('before-style')
    @include('includes.style')
    @stack('after-style')
    <style>
        .container,
        .row {
            height: 100%;
            min-height: 100%;
        }

        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Main content -->
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg text-muted">
                <div class="visible-print text-center mt-4">
                    {!! $barcode !!}
                </div>
                <h3 class="mt-4 text-center" style="font-size: 25px">Lokasi Parkir : {{$blok}}</h3>
                <p class="mt-4 text-center" style="font-size: 20px">Silahkan Scan QR Code <br> Saat Parkir Masuk Maupun Keluar</p>
                <p class="mt-0 text-center" style="font-size: 11px">*Silahkan Screenshoot QR Code untuk digunakan berulang kali.</p>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="py-2">
        <div class=" container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl">
                    <div class="copyright text-center text-muted">
                        &copy; 2022 <a href="#" class="font-weight-bold ml-1" target="_blank">Indomaret Group</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    {{-- Script --}}
    @include('includes.script')
    @stack('after-script')

</body>

</html>