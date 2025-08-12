@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 15px;
    }

    .form-label {
        font-weight: bold;
    }

    .save-btn {
        background: linear-gradient(90deg, #0d6efd, #084298);
        color: white;
        border: none;
    }

    .save-btn:hover {
        background: #0b5ed7;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center fs-4 fw-bold">
                    Edit Profil
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Alamat</label>
                            <input type="text" id="location" name="location" class="form-control"
                                value="{{ old('location', $user->location) }}">
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                value="{{ old('phone', $user->phone) }}">
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn save-btn py-2">Simpan Perubahan</button>
                        </div>

                        <!-- Notifikasi berhasil -->
                        @if (session('status') === 'profile-updated')
                            <div class="alert alert-success mt-3 mb-0" role="alert">
                                Profil berhasil diperbarui.
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
