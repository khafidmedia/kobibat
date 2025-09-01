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

        @media (min-width: 1200px) {
            .navbar-center {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
</head>

<body style="padding-top: 70px;">
    <!-- ✅ Navbar Fixed -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm w-100 fixed-top">
        <div class="container-fluid px-5 position-relative">

            <!-- LOGO + NAMA -->
            <a class="navbar-brand d-flex align-items-center fw-bold text-primary" href="#">
                <img src="{{ asset('LOGO_SMK.png') }}" alt="Logo" class="navbar-logo">
                KOBIBAT
            </a>

            <!-- TOGGLER -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENU -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
                <ul class="navbar-nav navbar-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/shu') }}">SHU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/simpanan') }}">Simpan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/user/pinjaman/ajukan') }}">Pinjaman</a>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.anggota.index') }}">Kas Masuk</a>
                    </li>

                    @auth
                        {{-- Logout button bisa aktif di sini --}}
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.custom') }}">Login User</a>
                        </li>
                    @endauth

                    <!-- Live Chat dinamis -->
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('chat.admin') }}">Live Chat</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('chat.user') }}">Live Chat</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('chat.user') }}">Live Chat</a>
                        </li>
                    @endauth

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profile User</a>
                    </li>
                </ul>
            </div>

            <!-- LOGIN & LOGOUT (pojok kanan) -->
            <div class="d-none d-lg-flex align-items-center gap-2">
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger fw-bold" style="text-decoration:none;">
                            Logout
                        </button>
                    </form>
                @endauth

                <a href="{{ url('/admin/login') }}" class="btn btn-primary">Login Admin</a>
            </div>
        </div>
    </nav>

    <!-- ✅ Konten Dinamis -->
    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS (wajib untuk navbar toggle bekerja) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional Script -->
    <script>
        function clearNamaInput() {
            const input = document.getElementById('namaInput');
            if (input) {
                input.value = '';
                document.getElementById('formCari').submit();
            }
        }
    </script>
</body>
</html>