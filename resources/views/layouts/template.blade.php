<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Koperasi SHU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Koperasi SHU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shu.index') }}">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.shu.index') }}">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> --}}

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
