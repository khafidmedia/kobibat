@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }

    nav.navbar {
        display: none !important;
    }

    .sidebar {
        width: 220px;
        background: linear-gradient(180deg, #0d6efd, #084298);
        min-height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        padding: 20px 0;
        color: white;
        display: flex;
        flex-direction: column;
    }

    .sidebar h6 {
        text-align: center;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 20px;
        color: #ffffffcc;
    }

    .sidebar-section {
        padding: 0 0;
        display: flex;
        flex-direction: column;
        gap: 6px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .sidebar a,
    .sidebar .sidebar-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: white;
        text-decoration: none;
        padding: 8px 12px;
        font-size: 0.93rem;
        transition: 0.2s ease;
        border-radius: 4px;
    }

    .sidebar a:hover,
    .sidebar .sidebar-item:hover {
        background-color: rgba(255, 255, 255, 0.15);
        padding-left: 16px;
    }

    .main-content {
        margin-left: 240px;
        padding: 40px;
    }

    .profile-card {
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        max-width: 800px;
        margin: 0 auto;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-left: 5px;
    }

    .save-btn {
        background: linear-gradient(90deg, #0d6efd, #084298);
        color: white;
        border: none;
    }

    .hidden-file-input {
        display: none;
    }
</style>

<div class="sidebar">
    <div class="sidebar-section">
        <h6>Halaman Profil</h6>
        <a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i> Dashboard</a>
        <a href="{{ route('profile') }}"><i class="bi bi-person-circle"></i> Profil</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="sidebar-section mt-3">
        <div class="sidebar-item"><i class="bi bi-person"></i> Akun</div>
        <div class="sidebar-item"><i class="bi bi-lock"></i> Keamanan</div>
        <div class="sidebar-item"><i class="bi bi-bell"></i> Notifikasi</div>
        <div class="sidebar-item"><i class="bi bi-gear"></i> Pengaturan</div>
    </div>
</div>

<div class="main-content">
    <div class="profile-card">
        <h1 class="fw-bold mb-4">Profil</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" value="" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" class="form-control" value="{{ $user->location ?? 'Belum diisi' }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" value="{{ $user->phone ?? 'Belum diisi' }}" readonly>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn save-btn px-4 py-2 mt-3">Edit Profil</a>
            </div>
            <div class="col-md-4 d-flex flex-column align-items-center">
                <img src="{{ $user->profile_photo_url }}" alt="Profile" class="profile-image mb-2">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="hidden-file-input" onchange="this.form.submit()">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('profile_photo').click()">
                        <i class="bi bi-camera-fill"></i> Ganti Foto
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection