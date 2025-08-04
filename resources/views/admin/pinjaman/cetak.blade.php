<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengajuan Pinjaman</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            font-size: 13px;
            background: #fff;
            padding: 30px;
            color: #333;
        }
        h2, h5 {
            text-align: center;
            margin-bottom: 20px;
            color: #0d6efd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        table th, table td {
            padding: 8px;
            border: 1px solid #dee2e6;
            text-align: left;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 12px;
        }
        .status-approved { background-color: #c8e6c9; color: #2e7d32; }
        .status-rejected { background-color: #ffcdd2; color: #c62828; }
        .status-pending  { background-color: #fff3cd; color: #856404; }
        .section-title {
            margin-top: 30px;
            font-size: 16px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
            font-style: italic;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <h2>Detail Pengajuan Pinjaman</h2>

    <div class="section-title">Informasi Peminjam</div>
    <table>
        <tr>
            <td><strong>Nama</strong></td>
            <td>{{ optional($pinjaman->user)->name ?? $pinjaman->account_holder ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Jumlah Pinjaman</strong></td>
            <td>Rp {{ number_format($pinjaman->amount) }}</td>
        </tr>
        <tr>
            <td><strong>Durasi</strong></td>
            <td>{{ $pinjaman->duration_months }} bulan</td>
        </tr>
        <tr>
            <td><strong>Tujuan</strong></td>
            <td>{{ $pinjaman->purpose ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Status</strong></td>
            <td>
                <span class="badge
                    {{ $pinjaman->status == 'approved' ? 'status-approved' :
                       ($pinjaman->status == 'rejected' ? 'status-rejected' : 'status-pending') }}">
                    {{ ucfirst($pinjaman->status) }}
                </span>
            </td>
        </tr>
        <tr>
            <td><strong>Keterangan</strong></td>
            <td>{{ $pinjaman->notes ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Bank</strong></td>
            <td>{{ $pinjaman->bank_name ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>No. Rekening</strong></td>
            <td>{{ $pinjaman->bank_account ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Atas Nama</strong></td>
            <td>{{ $pinjaman->account_holder ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Pengajuan</strong></td>
            <td>{{ $pinjaman->created_at->format('d-m-Y') }}</td>
        </tr>
    </table>

    <div class="section-title">Riwayat Simpanan</div>
    @if($pinjaman->user && $pinjaman->user->savings->count())
    <table>
        <thead>
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
    @else
    <p class="text-muted">Tidak ada data simpanan dari anggota ini.</p>
    @endif

    <div class="footer">
        Dicetak pada {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y H:i') }} WIB
    </div>

</body>
</html>
