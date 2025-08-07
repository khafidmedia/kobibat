<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Halaman Admin')</title>

    <!-- ✅ Font & Tailwind CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2c3e50',
                        secondary: '#34495e',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- ✅ Navbar -->
    <nav class="bg-primary text-white px-6 py-4 shadow flex space-x-6">
        <a href="{{ route('kas-masuk.index') }}" class="hover:text-gray-300 transition">Kas Masuk</a>
        <a href="{{ route('anggota.index') }}" class="hover:text-gray-300 transition">Anggota</a>
        <a href="{{ route('admin.index') }}" class="hover:text-gray-300 transition">Admin</a>
    </nav>

    <!-- ✅ Konten Utama -->
    <main class="p-6 max-w-7xl mx-auto">
        @yield('content')
    </main>

</body>
</html>
