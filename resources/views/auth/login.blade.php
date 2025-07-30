<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrator</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
    }
    body {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    .left {
      width: 40%;
      background: white;
      padding: 60px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .left h2 {
      font-size: 26px;
      margin-bottom: 10px;
    }
    .left p {
      margin-bottom: 30px;
      color: #555;
    }
    .left form {
      display: flex;
      flex-direction: column;
    }
    .left label {
      font-size: 14px;
      margin-bottom: 5px;
    }
    .left input[type="text"],
    .left input[type="password"] {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 20px;
    }
    .left button {
      padding: 12px;
      background: #8a5be1;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 10px;
    }
    .left a {
      font-size: 14px;
      margin-top: 15px;
      color: #888;
      text-decoration: none;
    }
    .right {
      width: 60%;
      background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .right img {
  width: 100%;
  height: 100vh;
  object-fit: cover;
}

    @media(max-width: 768px) {
      .right {
        display: none;
      }
      .left {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="left">
    <img src="{{ asset('smk.jpg') }}" alt="Logo" style="width:150px; margin-bottom: 30px;">
    <h2>Login Administrator</h2>
    <p>Selamat Datang Admin</p>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <label for="email">Nama Pengguna*</label>
      <input type="text" name="email" id="email" required autofocus>

      <label for="password">Kata Sandi*</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">MASUK DI ADMINISTRATOR</button>
    </form>
    <a href="{{ url('/') }}">← Kembali ke halaman depan</a>
  </div>
  <div class="right">
    <img src="{{ asset('admin.jpg') }}" alt="Admin Illustration">
  </div>
</body>
</html>