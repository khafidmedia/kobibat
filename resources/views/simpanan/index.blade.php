@extends('layouts.user')

@section('content')
<style>
    .btn-primary {
        background-color: #34699A;
        border-color: #34699A;
    }

    .btn-primary:hover {
        background-color: #2c5a85;
        border-color: #2c5a85;
    }

    .btn-add {
        background-color: #34699A;
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-add:hover {
        background-color: #2c5a85;
        color: white;
    }

    .table-custom th {
        background-color: #34699A;
        color: white;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f6f8fb;
    }

    .badge-pending {
        background-color: #7F8CAA;
        color: white;
    }

    .heading-custom {
        color: #34699A;
    }

    .form-control:focus {
        border-color: #34699A;
        box-shadow: 0 0 0 0.2rem rgba(52, 105, 154, 0.25);
    }
</style>

<h4 class="mb-3 heading-custom">🔍 Cek Simpanan Anda</h4>

<div class="d-flex justify-content-between align-items-center mb-3" style="max-width: 100%;">
    {{-- Tombol Tambah --}}
    <a href="{{ route('simpanan.create') }}" class="btn-add">➕ Tambah Simpanan</a>

    {{-- Form Pencarian --}}
    <form method="GET" id="formCari">
        <div class="input-group" style="max-width: 500px;">
            <input type="text" name="nama" id="namaInput" class="form-control" placeholder="Masukkan nama Anda..." value="{{ request('nama') }}">
            @if(request('nama'))
                <button type="button" class="btn btn-outline-secondary" onclick="clearNamaInput()" title="Hapus">❌</button>
            @endif
            <button class="btn btn-primary" type="submit">🔍 Cari</button>
        </div>
    </form>
</div>

@if($data->count() > 0)
    <table class="table table-bordered table-hover table-striped table-custom">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Bukti Transfer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $item)
            <tr class="align-middle">
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td class="text-center text-capitalize">{{ str_replace('_', ' ', $item->jenis) }}</td>
                <td class="text-end">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                <td class="text-center">
                    @if ($item->status === 'pending')
                        <span class="badge badge-pending"><i class="bi bi-hourglass-split"></i> Menunggu</span>
                    @elseif ($item->status === 'disetujui')
                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Diterima</span>
                    @elseif ($item->status === 'ditolak')
                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Ditolak</span>
                    @else
                        <span class="badge bg-secondary">-</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($item->bukti_transfer)
                        <img src="{{ asset('storage/' . $item->bukti_transfer) }}" width="80" class="img-thumbnail">
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    @if(request('nama'))
        <div class="alert alert-info">
            Tidak ada data ditemukan untuk nama <strong>{{ request('nama') }}</strong>.
        </div>
    @else
        <div class="alert alert-warning">
            📭 Belum ada simpanan yang dibuat.
        </div>
    @endif
@endif
 

<script>
    function clearNamaInput() {
        document.getElementById('namaInput').value = '';
        document.getElementById('formCari').submit();
    }
</script>
@endsection
