@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header"><h5>Edit Kas Masuk</h5></div>
        <div class="card-body">
            <form action="{{ route('admin.kas_masuk.update', $kas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $kas->tanggal }}" required>
                </div>

                <div class="mb-3">
                    <label>Nama Anggota</label>
                    <select name="anggota_id" class="form-select" required>
                        @foreach($anggota as $a)
                            <option value="{{ $a->id }}" @if($kas->anggota_id==$a->id) selected @endif>{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Sumber</label>
                    <input type="text" name="sumber" class="form-control" value="{{ $kas->sumber }}" required>
                </div>

                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ $kas->jumlah }}" min="0" required>
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control">{{ $kas->keterangan }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.kas_masuk.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
