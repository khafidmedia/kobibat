<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>KOBIBAT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ✅ Bootstrap 5.2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
        .navbar-logo {
            width: 40px;
            height: 40px;
            margin-right: 12px;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: #0d6efd !important;
        }

        .navbar-nav .nav-link:hover {
            font-weight: 600;
            color: #0b5ed7 !important;
        }

        /* Menu center fix */
        @media (min-width: 1200px) {
            .navbar-center {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
  </head>
      <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm w-100">
        <div class="container-fluid px-5 position-relative">

            {{-- LOGO + NAMA --}}
            <a class="navbar-brand d-flex align-items-center fw-bold text-primary" href="#">
                <img src="{{ asset('LOGO_SMK.png') }}" alt="Logo" class="navbar-logo">
                KOBIBAT
            </a>

            {{-- TOGGLER (HP) --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- MENU TENGAH --}}
            <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
                <ul class="navbar-nav navbar-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">SHU</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/simpanan') }}">Simpan</a></li> 
                    <li class="nav-item"><a class="nav-link" href="#">Pinjaman</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kas Masuk</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Live Chat</a></li>
                </ul>
            </div>

            {{-- LOGIN BUTTON KANAN --}}
            <div class="d-none d-lg-block">
                <a href="#" class="btn btn-primary">Login</a>
            </div>
        </div>
    </nav>
  <body class="container py-4">
    @yield('content')
  </body>
  <script>
    function clearNamaInput() {
        const input = document.getElementById('namaInput');
        input.value = '';
        document.getElementById('formCari').submit(); // auto-reload tanpa nama
    }
</script>