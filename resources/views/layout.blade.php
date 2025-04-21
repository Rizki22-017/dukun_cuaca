<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perjalanan Dinas</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .date-label {
            font-size: 0.9rem;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .date-info {
            background-color: red;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 5px;
            float: right;
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/">Nama User</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="#">Keluar</a>
            </div>
        </div>
    </header>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu"
                class="d-flex flex-column flex-shrink-0 col-md-3 col-lg-2 d-md-block text-white bg-dark sidebar collapse">
                <hr>
                <ul class="nav nav-pills flex-column nav-pills">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $title === 'Dashboard' ? 'active' : '' }}" aria-current="page"
                            href="/">
                            <span data-feather="home" class="align-text-bottom"></span>
                            Dashboard {{-- Semua User --}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $title === 'Admin' ? 'active' : '' }}" href="/Admin">
                            <span data-feather="file" class="align-text-bottom"></span>
                            Menu Admin {{-- Admin --}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $title === 'Pegawai' ? 'active' : '' }}" href="/Pegawai">
                            <span data-feather="shopping-cart" class="align-text-bottom"></span>
                            Data Pegawai {{-- Admin --}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $title === 'Pimpinan' ? 'active' : '' }}" href="/Pimpinan">
                            <span data-feather="users" class="align-text-bottom"></span>
                            Data Pimpinan {{-- Admin --}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $title === 'St' ? 'active' : '' }}" href="/St">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Surat Tugas{{-- Admin --}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $title === 'Nota Dinas' ? 'active' : '' }}" href="/NotaDinas">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            Nota Dinas {{-- Pimpinan --}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $title === 'Laporan Perjalanan Dinas' ? 'active' : '' }}"
                            href="/LaporanPerjalananDinas">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            Laporan Perjalanan Dinas {{-- Pegawai, Pimpinan --}}
                        </a>
                    </li>
                </ul>
                <hr>
        </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">{{ $subtitle }}</h1>
                <div class="date-info d-flex justify-content-between align-items-center mb-3" id="currentDate"></div>
            </div>
            @yield('container')
        </main>

    </div>
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>
    <script src="/js/dashboard.js"></script>

    <script>
        // Format tanggal hari ini ke format lokal Indonesia
        const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
            'November', 'Desember'
        ];

        const today = new Date();
        const formattedDate =
            `${hari[today.getDay()]}, ${today.getDate().toString().padStart(2, '0')} ${bulan[today.getMonth()]} ${today.getFullYear()}`;

        document.getElementById('currentDate').textContent = formattedDate;

        const dateValue = today.toISOString().split('T')[0];
        document.getElementById('startDate').value = dateValue;
        document.getElementById('endDate').value = dateValue;
    </script>

    @yield('script')

</body>

</html>
