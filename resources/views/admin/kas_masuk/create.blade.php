@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Kas Masuk</h2>

    <!-- Form simpan kas masuk -->
    <form id="kasForm" action="{{ route('admin.kas_masuk.store') }}" method="POST">
        @csrf
        @method('POST') {{-- Tambahan method POST --}}

        <!-- Tanggal -->
        <div class="mb-4">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>

        <!-- Nama Anggota -->
        <div class="mb-4">
            <label for="anggota_id" class="form-label">Nama Anggota</label>
            <select name="anggota_id" id="anggota_id" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                <option value="1">Ahmad Rizki</option>
                <option value="2">Siti Nurhaliza</option>
                <option value="3">Budi Santoso</option>
                <option value="4">Rina Wijaya</option>
                <option value="5">Dian Pratama</option>
                <option value="6">Eko Prasetyo</option>
                <option value="7">Lina Marlina</option>
                <option value="8">Fajar Nugroho</option>
                <option value="9">Maya Sari</option>
                <option value="10">Rizal Fauzi</option>
            </select>
        </div>

        <!-- Sumber -->
        <div class="mb-4">
            <label for="sumber" class="form-label">Sumber</label>
            <input type="text" name="sumber" id="sumber" class="form-control" placeholder="Masukkan sumber kas" required>
        </div>

        <!-- Jumlah -->
        <div class="mb-4">
            <label for="jumlah" class="form-label">Jumlah (Rp)</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan jumlah" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
