@extends('layout')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Detail Simpanan</h4>

    <table class="table table-bordered">
        <tr>
            <th width="200">Nama</th>
            <td>{{ $data->nama }}</td>
        </tr>
        <tr>
            <th>Jenis Simpanan</th>
            <td>{{ $data->jenis }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>Rp {{ number_format($data->jumlah, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if ($data->status === 'pending')
                    <span class="badge bg-warning text-dark">Menunggu</span>
                @elseif ($data->status === 'disetujui')
                    <span class="badge bg-success">Diterima</span>
                @else
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Bukti Transfer</th>
            <td>
                @if ($data->bukti_transfer)
                    <a href="{{ asset('storage/' . $data->bukti_transfer) }}" target="_blank">
                        <img src="{{ asset('storage/' . $data->bukti_transfer) }}" width="200" class="img-thumbnail">
                    </a>
                    <p class="mt-2">{{ $data->bukti_transfer }}</p>
                @else
                    <p class="text-danger">Bukti belum diupload.</p>
                @endif
            </td>
        </tr>
    </table>

    {{-- Tombol Verifikasi Jika Masih Pending --}}
    @if ($data->status === 'pending')
    <div class="mb-3">
     <form action="{{ route('admin.simpanan.verifikasi', ['id' => $data->id, 'status' => 'disetujui']) }}" method="POST" style="display:inline;">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success">Setujui</button>
</form>

<form action="{{ route('admin.simpanan.verifikasi', ['id' => $data->id, 'status' => 'ditolak']) }}" method="POST" style="display:inline;">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-danger">Tolak</button>
</form>


    </div>
    @endif

    <a href="{{ route('admin.simpanan') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
