<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pinjaman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap dan Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border: none;
            border-radius: 1rem;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table thead {
            background-color: #0d6efd;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #eef4ff;
        }

        .status-approved {
            color: #198754;
            font-weight: 600;
        }

        .status-rejected {
            color: #dc3545;
            font-weight: 600;
        }

        .status-pending {
            color: #fd7e14;
            font-weight: 600;
        }

        .form-label {
            color: #0d6efd;
        }

        .btn-outline-primary {
            border-radius: 50px;
            padding: 8px 20px;
        }

        .form-select {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body class="p-4">

<div class="container">
    <!-- Judul dan Filter sejajar -->
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary mb-0">
                <i class="bi bi-clock-history me-2"></i>Riwayat Pinjaman
            </h2>
            <small class="text-muted">Berikut adalah daftar riwayat pengajuan pinjaman oleh pengguna.</small>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <form method="GET">
                <label for="filterNama" class="form-label fw-semibold d-block text-start text-md-end">
                    <i class="bi bi-funnel-fill me-1"></i>Filter berdasarkan nama:
                </label>
                <div class="input-group">
                    <select name="account_holder" id="filterNama" class="form-select shadow-sm" onchange="this.form.submit()">
                        <option value="">-- Semua nama --</option>
                        @foreach ($daftar_nama as $nama)
                            <option value="{{ $nama }}" {{ request('account_holder') == $nama ? 'selected' : '' }}>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Riwayat -->
    <div class="card shadow-sm">
        <div class="card-body">
            @if ($pinjamans->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Tujuan</th>
                            <th>Tanggal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pinjamans as $pinjaman)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('admin.pinjaman.show', $pinjaman->id) }}" class="text-decoration-none text-primary fw-semibold">
                                        {{ $pinjaman->account_holder ?? optional($pinjaman->user)->name ?? 'Tidak diketahui' }}
                                    </a>
                                </td>
                                <td>Rp {{ number_format($pinjaman->amount, 0, ',', '.') }}</td>
                                <td>{{ $pinjaman->duration_months }} bulan</td>
                                <td class="
                                    @if($pinjaman->status == 'disetujui') status-approved
                                    @elseif($pinjaman->status == 'ditolak') status-rejected
                                    @else status-pending
                                    @endif
                                ">
                                    {{ ucfirst($pinjaman->status) }}
                                </td>
                                <td>{{ $pinjaman->purpose }}</td>
                                <td>{{ $pinjaman->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center mb-0">
                    <i class="bi bi-exclamation-circle me-2"></i>Belum ada riwayat pinjaman.
                </div>
            @endif
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-4 text-end">
        <a href="{{ route('admin.pinjaman.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar
        </a>
    </div>
</div>

</body>
</html>
