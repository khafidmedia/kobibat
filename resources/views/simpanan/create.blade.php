@extends('layouts.user')

@section('content')
<style>
    .popup-box {
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.4s ease-in-out;
    }

    .popup-box h2 {
        margin-bottom: 20px;
        text-align: center;
        color: #34699A;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-control:focus {
        border-color: #34699A;
        box-shadow: 0 0 0 0.2rem rgba(52, 105, 154, 0.2);
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
</style>

<div class="popup-box">
    <h2>Tambah Simpanan</h2>

    <form action="{{ route('simpanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Simpanan</label>
            <select name="jenis" class="form-control" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="wajib">Wajib</option>
                <option value="pokok">Pokok</option>
                <option value="berjangka">Berjangka</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah (Rp)</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Upload Bukti Transfer (via DANA)</label>
            <input type="file" name="bukti_transfer" class="form-control">
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-success">💾 Simpan</button>
        </div>
    </form>
</div>
@endsection
