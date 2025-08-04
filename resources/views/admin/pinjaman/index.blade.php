<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Pengajuan Pinjaman</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
      border: none;
      border-radius: 16px;
    }
    .card-header {
      background: #ffffff;
      border-bottom: none;
    }
    .table th {
      background-color: #f1f3f5;
      font-size: 0.9rem;
      color: #555;
    }
    .badge {
      font-size: 0.75rem;
      border-radius: 8px;
      padding: 0.4em 0.7em;
    }
    .btn-outline-primary {
      border-radius: 8px;
    }
    .modal-content {
      border-radius: 16px;
    }
    .modal-header {
      border-bottom: none;
    }
    .modal-title {
      font-weight: bold;
    }
    .btn-close {
      filter: invert(1);
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-clipboard-data text-primary me-2"></i> Daftar Pengajuan Pinjaman</h4>
        <a href="{{ route('admin.pinjaman.riwayat') }}" class="btn btn-outline-secondary btn-sm">
          <i class="bi bi-clock-history me-1"></i> Riwayat
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Jumlah</th>
              <th>Durasi</th>
              <th>Tujuan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pinjamans as $pinjaman)
            <tr>
              <td>{{ $pinjaman->account_holder ?? 'Tidak diketahui' }}</td>
              <td>Rp {{ number_format($pinjaman->amount, 0, ',', '.') }}</td>
              <td>{{ $pinjaman->duration_months }} bulan</td>
              <td>{{ $pinjaman->purpose }}</td>
              <td>
                @switch($pinjaman->status)
                  @case('menunggu')
                    <span class="badge bg-secondary">Menunggu</span>
                    @break
                  @case('disetujui')
                    <span class="badge bg-success">Disetujui</span>
                    @break
                  @case('ditolak')
                    <span class="badge bg-danger">Ditolak</span>
                    @break
                  @default
                    <span class="badge bg-light text-dark">Tidak Diketahui</span>
                @endswitch
              </td>
              <td>
                <button
                  class="btn btn-outline-primary btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#modalVerifikasi"
                  data-id="{{ $pinjaman->id }}"
                  data-nama="{{ $pinjaman->user->name ?? 'Tidak diketahui' }}">
                  <i class="bi bi-check2-square me-1"></i> Verifikasi
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- MODAL VERIFIKASI -->
<div class="modal fade" id="modalVerifikasi" tabindex="-1" aria-labelledby="modalVerifikasiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-verifikasi" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalVerifikasiLabel"><i class="bi bi-shield-check me-2"></i> Verifikasi Pengajuan</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <p class="mb-3">Yakin ingin memverifikasi pengajuan dari <strong id="nama-peminjam">[Nama]</strong>?</p>
          <div class="form-group">
            <label for="status" class="form-label">Pilih Status:</label>
            <select name="status" class="form-select" required>
              <option value="">-- Pilih Status --</option>
              <option value="disetujui">Setujui</option>
              <option value="ditolak">Tolak</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const modal = document.getElementById('modalVerifikasi');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const nama = button.getAttribute('data-nama');
    const id = button.getAttribute('data-id');

    const namaSpan = modal.querySelector('#nama-peminjam');
    namaSpan.textContent = nama;

    const form = document.getElementById('form-verifikasi');
    form.action = `/admin/pinjaman/${id}/verifikasi`;
  });
</script>

</body>
</html>
