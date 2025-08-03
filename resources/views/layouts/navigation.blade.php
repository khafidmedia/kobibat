<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Koperasi Bisa-Hebat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }

    .container-fluid {
      height: 100vh;
    }

    .split-left {
      background-color: #fff;
      padding: 60px 60px 0 60px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      height: 100%;
    }

    .welcome-text {
      font-size: 16px;
      margin-top: 10px;
      color: #555;
    }

    .highlight {
      color: #0d6efd;
      font-weight: bold;
      font-style: italic;
    }

    .split-right {
      padding: 0;
      height: 100%;
      display: flex;
    }

    .split-right img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      padding: 20px;
    }

    .form-label {
      font-weight: bold;
    }

    .btn-login {
      width: 100%;
      background-color: #0d6efd;
      color: white;
      font-weight: bold;
    }

    .btn-login:hover {
      background-color: #0a58ca;
    }

    h1 {
      font-size: 42px;
      font-weight: 900;
      margin-bottom: 10px;
    }

    .register-link {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
    }

    .register-link a {
      font-weight: bold;
      color: #0d6efd;
      text-decoration: none;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .split-right {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row g-0 h-100">
      <!-- KIRI: FORM LOGIN -->
      <div class="col-md-6 split-left">
        <h1>Login</h1>
        <p class="welcome-text">
          Selamat datang di halaman login, bergabung bersama koperasi kami di
          <span class="highlight">"Koperasi Bisa-Hebat"</span> dengan tim profesional.
        </p>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3 mt-4">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus>
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-login">Masuk</button>
        </form>

        <!-- Tombol Daftar -->
        <div class="register-link">
          Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
      </div>

      <!-- KANAN: GAMBAR -->
      <div class="col-md-6 split-right d-none d-md-flex">
        <img src="{{ asset('images/banner-login.jpg') }}" alt="Login Banner">
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>