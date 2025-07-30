<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Artikel Media</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Tombol Tambah Artikel hanya untuk admin -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('articles.index') }}">Landing Page</a>

            @auth
                @if (auth()->user()->role === 'admin')
                    <a class="btn btn-outline-primary ms-auto" href="{{ route('articles.create') }}">+ Tambah Artikel</a>
                @endif
            @endauth
        </div>
    </nav>


    <div class="py-4">
        @yield('content')
    </div>
</body>

</html>
