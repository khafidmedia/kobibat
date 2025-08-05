@extends('layouts.template')

@section('content')
<div class="container mt-5">
    <h4>Hasil Perhitungan SHU untuk <strong>{{ $nama }}</strong></h4>
    <table class="table table-bordered">
        <tr>
            <th>SHU Total</th>
            <td>Rp {{ number_format($shu) }}</td>
        </tr>
        <tr>
            <th>Jasa Anggota (40%)</th>
            <td>Rp {{ number_format($porsi['jasa_anggota']) }}</td>
        </tr>
        <tr>
            <th>Cadangan (30%)</th>
            <td>Rp {{ number_format($porsi['cadangan']) }}</td>
        </tr>
        <tr>
            <th>Sosial (20%)</th>
            <td>Rp {{ number_format($porsi['sosial']) }}</td>
        </tr>
        <tr>
            <th>Manajemen (10%)</th>
            <td>Rp {{ number_format($porsi['manajemen']) }}</td>
        </tr>
    </table>
</div>
@endsection
