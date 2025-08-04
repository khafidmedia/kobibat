<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengajuan Pinjaman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #ffffff, #ffffff);
            font-family: 'Inter', sans-serif;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .card-header {
            background: linear-gradient(120deg, #6a11cb, #2575fc);
            color: #fff;
            padding: 2rem;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .card-header i {
            font-size: 2rem;
            background: #fff;
            color: #2575fc;
            padding: 10px;
            border-radius: 50%;
            margin-right: 1rem;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .card-footer {
            background-color: #fff;
            font-size: 0.875rem;
            color: #ffffff;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }

        .form-check-label a {
            text-decoration: underline;
            color: #0d6efd;
        }

        .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }
    </style>
</head>
<body>

<div class="container my-5">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

<div class="card shadow-lg border-0 rounded-4 overflow-hidden">
    <div class="card-header bg-primary bg-gradient text-white py-4 px-5 d-flex align-items-center gap-3">
        <div class="bg-white rounded-circle p-2">
        </div>
        <div>
            <h5 class="mb-0 fw-bold">Form Pengajuan Pinjaman</h5>
            <small class="text-white">Lengkapi data dengan benar ya!</small>
        </div>
    </div>
</div>

<div class="card-body p-4">
    <form action="{{ route('user.pinjaman.store') }}" method="POST">
        @csrf

        {{-- Nama Lengkap --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input name="full_name" type="text" class="form-control" placeholder="Contoh: Andi Wijaya" value="{{ old('full_name') }}">
            @error('full_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Jumlah Pinjaman --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Jumlah Pinjaman</label>
            <input name="amount" type="number" class="form-control" placeholder="Contoh: 5000000" value="{{ old('amount') }}">
            @error('amount') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Jangka Waktu --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Jangka Waktu (bulan)</label>
            <input name="duration_months" type="number" class="form-control" placeholder="Contoh: 12" value="{{ old('duration_months') }}">
            @error('duration_months') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Tujuan --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Tujuan Pinjaman</label>
            <input name="purpose" type="text" class="form-control" placeholder="Contoh: Modal Usaha" value="{{ old('purpose') }}">
            @error('purpose') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <hr class="my-4">
        <h6 class="text-muted fw-bold">Info Rekening (Opsional)</h6>

        {{-- No Rekening --}}
        <div class="mb-3 mt-3">
            <label class="form-label fw-normal">No. Rekening</label>
            <input name="bank_account" type="text" class="form-control" value="{{ old('bank_account') }}">
            @error('bank_account') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Nama Bank --}}
        <div class="mb-3">
            <label class="form-label fw-normal">Nama Bank</label>
            <input name="bank_name" type="text" class="form-control" value="{{ old('bank_name') }}">
            @error('bank_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Pemilik Rekening --}}
        <div class="mb-3">
            <label class="form-label fw-normal">Nama Pemilik Rekening</label>
            <input name="account_holder" type="text" class="form-control" value="{{ old('account_holder') }}">
            @error('account_holder') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Keterangan --}}
        <div class="mb-4">
            <label class="form-label fw-normal">Keterangan Tambahan</label>
            <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
            @error('notes') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Checkbox Syarat --}}
        <div class="form-check mb-4">
            <input name="agreed" class="form-check-input" type="checkbox" id="agreeTerms" value="1" {{ old('agreed') ? 'checked' : '' }}>
            <label class="form-check-label" for="agreeTerms">
                Saya menyetujui
                <a href="#" class="text-decoration-underline" data-bs-toggle="modal" data-bs-target="#syaratModal">
                    syarat dan ketentuan koperasi
                </a>
            </label>
            @error('agreed') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Tombol Submit --}}
        <button class="btn w-100 py-2 fw-bold shadow-sm text-white" style="background-color: #18632c;" type="submit">
            <i class="bi bi-send-fill me-1"></i> Kirim Permohonan
        </button>
    </form>
</div>


{{-- 🔽 Modal Syarat dan Ketentuan --}}
<div class="modal fade" id="syaratModal" tabindex="-1" aria-labelledby="syaratModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="syaratModalLabel">Syarat dan Ketentuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                @include('user.pinjaman.syarat') {{-- Ganti dengan isi langsung jika ingin tanpa include --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
