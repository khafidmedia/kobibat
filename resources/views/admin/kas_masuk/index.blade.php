@extends('layouts.app')

@section('content')
<div class="mt-6">

    <h1 class="text-2xl font-semibold mb-4">Data Anggota</h1>

    <a href="{{ route('kas_masuk.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded mb-4 hover:bg-blue-700">
        + Tambah Anggota
    </a>

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
                    <th class="px-4 py-2 border text-left font-semibold">Nominal (Rp)</th>
                    <th class="px-4 py-2 border text-left font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggotas as $anggota)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $anggota->nama }}</td>
                        <td class="px-4 py-2 border">{{ $anggota->no_hp ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $anggota->alamat ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $anggota->status ?? 'Aktif' }}</td>
                        <td class="px-4 py-2 border">{{ number_format($anggota->nominal, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border space-x-2">
                            {{-- Tombol Edit --}}
                            {{-- <a href="{{ route('kas_masuk.edit', $anggota->id) }}"
                               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                Edit
                            </a> --}}

                            {{-- Tombol Hapus --}}
                            {{-- <form action="{{ route('kas_masuk.destroy', $anggota->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                    Hapus
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center px-4 py-4 text-gray-500">Belum ada data anggota.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
