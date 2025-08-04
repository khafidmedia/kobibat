<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pinjaman Saya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .badge {
            font-size: 0.85rem;
            padding: 6px 10px;
        }
        .success-message {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 10px 15px;
            border-radius: 6px;
        }
        .table thead {
            background-color: #0d6efd;
            color: white;
        }
        .text-muted-small {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="card p-4">
        <div class="text-center mb-3">
            <h2 class="card-title"><i class="bi bi-clock-history me-2"></i>Riwayat Pinjaman Saya</h2>
            <p class="text-muted-small">Data di bawah menampilkan semua pinjaman yang pernah Anda ajukan.</p>
        </div>

        @if(session('success'))
            <div class="success-message mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Jumlah</th>
                        <th>Durasi</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pinjamans as $pinjam)
                        <tr>
                            <td>{{ $pinjam->account_holder ?? optional($pinjam->user)->name ?? 'Tidak diketahui' }}</td>
                            <td>Rp{{ number_format($pinjam->amount, 0, ',', '.') }}</td>
                            <td>{{ $pinjam->duration_months }} bulan</td>
                            <td>{{ $pinjam->purpose }}</td>
                            <td>
                                <span class="badge
                                    @if($pinjam->status == 'disetujui') bg-success
                                    @elseif($pinjam->status == 'ditolak') bg-danger
                                    @else bg-warning text-dark
                                    @endif">
                                    {{ ucfirst($pinjam->status) }}
                                </span>
                            </td>
                            <td>{{ $pinjam->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada riwayat pinjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
