<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Pinjaman</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      border-radius: 1rem;
      border: none;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    .badge-status {
      font-size: 0.9rem;
      padding: 0.4rem 0.8rem;
      border-radius: 0.5rem;
    }

    .status-approved { background-color: #d4edda; color: #155724; }
    .status-rejected { background-color: #f8d7da; color: #721c24; }
    .status-pending  { background-color: #fff3cd; color: #856404; }

    .list-group-item strong {
      width: 170px;
      display: inline-block;
      color: #495057;
    }

    .btn-action {
      width: 120px;
    }

    .section-title {
      font-weight: bold;
      font-size: 1.25rem;
      color: #495057;
    }

    .btn-back {
      float: right;
      margin-top: 1rem;
    }
  </style>
</head>
<body class="container py-5">

  <!-- Judul dan Tombol Cetak sejajar -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-primary mb-0"><i class="bi bi-info-circle me-2"></i>Detail Pinjaman</h2>
      <small class="text-muted">Informasi lengkap permohonan dari anggota koperasi</small>
    </div>
    <a href="{{ route('admin.pinjaman.cetak', $pinjaman->id) }}" target="_blank" class="btn btn-outline-primary">
      <i class="bi bi-printer"></i> Cetak PDF
    </a>
  </div>

  <!-- Informasi Peminjam -->
  <div class="card p-4 mb-4">
    <div class="section-title mb-3"><i class="bi bi-person"></i> Informasi Peminjam</div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><strong>Nama:</strong> {{ optional($pinjaman->user)->name ?? $pinjaman->account_holder ?? 'Tidak diketahui' }}</li>
      <li class="list-group-item"><strong>Jumlah Pinjaman:</strong> Rp {{ number_format($pinjaman->amount) }}</li>
      <li class="list-group-item"><strong>Durasi:</strong> {{ $pinjaman->duration_months }} bulan</li>
      <li class="list-group-item"><strong>Tujuan:</strong> {{ $pinjaman->purpose ?? '-' }}</li>
      <li class="list-group-item"><strong>Status:</strong>
        <span class="badge badge-status
          {{ $pinjaman->status == 'approved' ? 'status-approved' :
             ($pinjaman->status == 'rejected' ? 'status-rejected' : 'status-pending') }}">
          {{ ucfirst($pinjaman->status) }}
        </span>
      </li>
      <li class="list-group-item"><strong>Keterangan:</strong> {{ $pinjaman->notes ?? '-' }}</li>
      <li class="list-group-item"><strong>Bank:</strong> {{ $pinjaman->bank_name ?? '-' }}</li>
      <li class="list-group-item"><strong>No. Rekening:</strong> {{ $pinjaman->bank_account ?? '-' }}</li>
      <li class="list-group-item"><strong>Atas Nama:</strong> {{ $pinjaman->account_holder ?? '-' }}</li>
    </ul>

    @if($pinjaman->status === 'pending')
    <div class="mt-4 d-flex justify-content-center gap-3">
      <form action="{{ route('admin.pinjaman.setujui', $pinjaman->id) }}" method="POST">
        @csrf @method('PUT')
        <button class="btn btn-success btn-action"><i class="bi bi-check-circle"></i> Setujui</button>
      </form>
      <form action="{{ route('admin.pinjaman.tolak', $pinjaman->id) }}" method="POST">
        @csrf @method('PUT')
        <button class="btn btn-danger btn-action"><i class="bi bi-x-circle"></i> Tolak</button>
      </form>
    </div>
    @endif
  </div>

  <!-- Riwayat Simpanan -->
  <div class="card p-4 mb-4">
    <div class="section-title mb-3"><i class="bi bi-clock-history"></i> Riwayat Simpanan</div>
    @if($pinjaman->user && $pinjaman->user->savings->count())
    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Jenis</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pinjaman->user->savings as $s)
          <tr>
            <td>{{ $s->created_at->format('d-m-Y') }}</td>
            <td>Rp {{ number_format($s->amount) }}</td>
            <td>{{ ucfirst($s->type) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    <p class="text-muted">Tidak ada data simpanan dari anggota ini.</p>
    @endif
  </div>

  <!-- Tombol Kembali di sebelah kanan -->
  <div class="text-end">
    <a href="{{ route('admin.pinjaman.index') }}" class="btn btn-outline-secondary btn-back">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>
  </div>

</body>
</html>
