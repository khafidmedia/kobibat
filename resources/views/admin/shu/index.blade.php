@extends('layouts.template')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">📊 Riwayat Perhitungan SHU</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Pendapatan</th>
                <th>Biaya</th>
                <th>SHU</th>
                <th>Jasa Anggota</th>
                <th>Cadangan</th>
                <th>Sosial</th>
                <th>Manajemen</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shus as $shu)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $shu->nama }}</td>
                <td>Rp {{ number_format($shu->pendapatan) }}</td>
                <td>Rp {{ number_format($shu->biaya) }}</td>
                <td>Rp {{ number_format($shu->shu) }}</td>
                <td>Rp {{ number_format($shu->jasa_anggota) }}</td>
                <td>Rp {{ number_format($shu->cadangan) }}</td>
                <td>Rp {{ number_format($shu->sosial) }}</td>
                <td>Rp {{ number_format($shu->manajemen) }}</td>
                <td>{{ $shu->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $shus->links() }}
</div>
@endsection
