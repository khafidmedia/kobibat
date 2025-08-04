@extends('layouts.admin_simpanan')

@section('content')
 {{-- Ini memanggil navbar --}}

<style>
    .custom-header {
        background-color: #34699A;
        color: #fff;
    }

    .custom-btn-primary {
        background-color: #34699A;
        border-color: #34699A;
    }

    .custom-btn-primary:hover {
        background-color: #2e5d88;
        border-color: #2e5d88;
    }

    .custom-btn-secondary {
        background-color: #7F8CAA;
        border-color: #7F8CAA;
        color: #fff;
    }

    .custom-btn-secondary:hover {
        background-color: #6c778b;
        border-color: #6c778b;
        color: #fff;
    }

    .custom-table th,
    .custom-table td {
        vertical-align: middle;
    }
    .navbar {
        background-color: #34699A; /* Warna biru */
    }
    .navbar-brand,
    .navbar-brand strong {
        color: rgb(7, 7, 7) !important;
    }

</style>

<div class="container mt-3">

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Daftar Simpanan</h4>

    <form method="GET" class="d-flex align-items-center" style="gap: 8px;">
        <input type="text" name="nama" class="form-control" placeholder="Cari nama..." style="width: 200px;" value="{{ request('nama') }}">
        <button type="submit" class="btn btn-primary">🔍</button>
    </form>
</div>


<table class="table table-bordered table-hover custom-table">
    <thead class="text-center custom-header">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Bukti Transfer</th>
            <th>Aksi</th>
        </tr>
    </thead>

        <tbody>
            @foreach ($dataSimpanan as $index => $item)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                    <td>
@if ($item->status === 'pending')
 <form action="{{ route('admin.simpanan.verifikasi', [$item->id, 'disetujui']) }}" method="POST" class="d-inline">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-sm btn-success"
        onclick="return confirm('Yakin ingin menyetujui simpanan ini?')">Terima</button>
</form>

<form action="{{ route('admin.simpanan.verifikasi', [$item->id, 'ditolak']) }}" method="POST" class="d-inline">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-sm btn-danger"
        onclick="return confirm('Yakin ingin menolak simpanan ini?')">Tolak</button>
</form>

@else
    <span class="badge bg-secondary">Sudah Diverifikasi</span>
@endif


                    </td>
                    <td>
                        @if($item->bukti_transfer)
                            <img src="{{ asset('storage/' . $item->bukti_transfer) }}" width="80"
                                class="img-thumbnail" style="cursor: zoom-in;"
                                onclick="tampilkanGambar('{{ asset('storage/' . $item->bukti_transfer) }}')">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex flex-column gap-1">
                            <a href="{{ route('admin.simpanan.show', $item->id) }}" class="btn btn-sm btn-primary">Show</a>

                            @if ($item->status === 'pending')
                               
                            @else
                                <span class="badge bg-secondary">Sudah Diverifikasi</span>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Gambar Bukti Transfer -->
<div class="modal fade" id="modalGambar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-body text-center">
                <img id="gambarModalSrc" src="" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function tampilkanGambar(src) {
        document.getElementById('gambarModalSrc').src = src;
        var modal = new bootstrap.Modal(document.getElementById('modalGambar'));
        modal.show();
    }
</script>
@endsection
