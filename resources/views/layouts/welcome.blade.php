@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div style="padding: 30px;">
    <h2 style="font-size: 28px; margin-bottom: 24px;">Dashboard Admin</h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">

        {{-- Data Anggota --}}
        <div style="background-color: #f8f9fa; border-radius: 12px; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); text-align: center;">
            <h3 style="margin-bottom: 10px;">Data Anggota</h3>
            <p style="color: #555;">Kelola data anggota koperasi.</p>
            <a href="{{ route('anggota.index') }}" style="display: inline-block; margin-top: 12px; padding: 8px 16px; background-color: #007bff; color: white; text-decoration: none; border-radius: 6px;">Kelola</a>
        </div>

        {{-- Kas Masuk --}}
        <div style="background-color: #f8f9fa; border-radius: 12px; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); text-align: center;">
            <h3 style="margin-bottom: 10px;">Kas Masuk</h3>
            <p style="color: #555;">Lihat dan tambah data kas masuk.</p>
            <a href="{{ route('anggota.index') }}" style="display: inline-block; margin-top: 12px; padding: 8px 16px; background-color: #28a745; color: white; text-decoration: none; border-radius: 6px;">Kelola</a>
        </div>

    </div>
</div>
@endsection
