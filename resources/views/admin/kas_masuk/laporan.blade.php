@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Kas Masuk</h1>

    <div class="mb-3">
        <strong>Total Kas Masuk:</strong> Rp {{ number_format($totalKas, 0, ',', '.') }}
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Tanggal</th>
                <th>Anggota</th>
                <th>Sumber</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kasMasuks as $kas)
                <tr>
                    <td>{{ $kas->tanggal }}</td>
                    <td>{{ $kas->anggota }}</td>
                    <td>{{ $kas->sumber }}</td>
                    <td>{{ $kas->keterangan }}</td>
                    <td>Rp {{ number_format($kas->jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
