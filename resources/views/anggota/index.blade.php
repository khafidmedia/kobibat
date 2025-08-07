@extends('layouts.app')

@section('content')
<div class="mt-6">
    <h1 class="text-2xl font-semibold mb-4 text-white">Data Anggota</h1>

    {{-- Tampilkan pesan sukses jika ada --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Data Anggota --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 bg-white">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border text-left font-semibold">Nama</th>
                    <th class="px-4 py-2 border text-left font-semibold">No HP</th>
                    <th class="px-4 py-2 border text-left font-semibold">Alamat</th>
                    <th class="px-4 py-2 border text-left font-semibold">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggotas as $anggota)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $anggota->nama }}</td>
                        <td class="px-4 py-2 border">{{ $anggota->no_hp ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $anggota->alamat ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $anggota->status ?? 'Aktif' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center px-4 py-4 text-gray-500">Belum ada data anggota.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
