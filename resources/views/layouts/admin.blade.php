<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - KOBIBAT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            flex-shrink: 0;
            padding: 20px;
        }
        .sidebar .brand h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .sidebar .brand h5 {
            font-size: 0.9rem;
            color: #ccc;
        }
        .sidebar a {
            display: block;
            color: #fff;
            padding: 10px 0;
            text-decoration: none;
            margin: 5px 0;
            border-radius: 4px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .header {
            background-color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dee2e6;
        }
        .header-logo {
            height: 40px;
            margin-right: 10px;
        }
        .logout-btn {
            background-color: #dc3545;
            border: none;
            color: #fff;
            padding: 5px 12px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    {{-- Main --}}
    <div class="main">
        {{-- Header --}}
        <div class="header">
            <div class="logo-title d-flex align-items-center">
                <img src="{{ asset('images/logo-SMK.png') }}" alt="Logo Koperasi" class="header-logo">
                <h1 class="h5 m-0">Dashboard Admin</h1>
            </div>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        {{-- Konten --}}
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>
