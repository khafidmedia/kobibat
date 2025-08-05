<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
  <form method="POST" action="/admin/login" class="bg-white p-4 rounded shadow" style="width: 300px;">
    @csrf
    <h4 class="mb-3 text-center">Admin Login</h4>
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="mb-3">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <button class="btn btn-primary w-100">Login</button>
  </form>
</body>
</html>
