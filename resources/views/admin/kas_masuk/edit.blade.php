@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Kas Masuk</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kas-masuk.update', $kasMasuk->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $kasMasuk->tanggal }}" required>
            </div>

            <div class="mb-3">
                <label for="anggota_id" class="form-label">Nama Anggota</label>
                <select name="anggota_id" class="form-control" required>
                    @foreach ($anggotas as $anggota)
                        <option value="{{ $anggota->id }}" {{ $kasMasuk->anggota_id == $anggota->id ? 'selected' : '' }}>
                            {{ $anggota->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="sumber" class="form-label">Sumber</label>
                <input type="text" name="sumber" class="form-control" value="{{ $kasMasuk->sumber }}" required>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{ $kasMasuk->jumlah }}" required>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ $kasMasuk->keterangan }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('kas-masuk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
