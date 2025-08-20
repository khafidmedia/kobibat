@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="container">

    {{-- Judul + Tombol dalam satu baris --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold" style="color: #ff6600;"><i>Daftar Artikel</i></h2>

        {{-- Tombol Tambah Artikel hanya untuk admin --}}
        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.articles.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah Artikel
                </a>
            @endif
        @endauth
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Daftar artikel --}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($articles as $article)
            <div class="col">
                <div class="card h-100">
                    @if ($article->photo)
                        <img src="{{ asset('storage/' . $article->photo) }}" class="card-img-top"
                            style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column justify-content-between">
                        {{-- Header --}}
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="bg-light p-3 rounded shadow-sm">
                                <h5 class="fw-semibold text-primary mb-2">{{ $article->title }}</h5>
                                <p class="mb-0 text-muted">
                                    <i class="bi bi-eye-fill me-1"></i>{{ number_format($article->views) }}x dilihat
                                </p>
                            </div>
                        </div>

                        {{-- Deskripsi singkat --}}
                        <p class="card-text">{{ Str::limit($article->description, 100) }}</p>

                        {{-- Audio --}}
                        @if ($article->audio)
                            <audio controls class="w-100 mb-2">
                                <source src="{{ asset('storage/' . $article->audio) }}">
                            </audio>
                        @endif

                        {{-- Tombol aksi --}}
                        <div class="d-flex justify-content-between gap-2 mt-auto">
                            <a href="{{ route('admin.articles.show', $article->id) }}" class="btn btn-primary btn-sm flex-fill">Lihat</a>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning btn-sm flex-fill">Edit</a>
                            <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}" class="flex-fill">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm w-100">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada artikel tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
