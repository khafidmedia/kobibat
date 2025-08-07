@extends('layouts.app')

@section('title', 'Detail Kas Masuk')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Kas Masuk</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $kasMasuk->tanggal }}</td>
                </tr>
                <tr>
                    <th>Nama Anggota</th>
                    <td>{{ $kasMasuk->anggota->nama }}</td>
                </tr>
                <tr>
                    <th>Sumber</th>
                    <td>{{ $kasMasuk->sumber }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>Rp {{ number_format($kasMasuk->jumlah, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $kasMasuk->keterangan ?? '-' }}</td>
                </tr>
            </table>

            <a href="{{ route('kas-masuk.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>
@endsection
