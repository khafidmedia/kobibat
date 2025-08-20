@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <div class="container">
        <h2 class="fw-bold" style="color: #ff6600;"><i>Daftar Artikel</i></h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($articles as $article)
                <div class="col">
                    <div class="card h-100">
                        @if ($article->photo)
                            <img src="{{ asset('storage/' . $article->photo) }}" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column justify-content-between">
                            {{-- Header dengan tombol Like di kanan --}}
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="bg-light p-3 rounded shadow-sm">
                                    <h5 class="fw-semibold text-primary mb-2">{{ $article->title }}</h5>
                                    <p class="mb-0 text-muted">
                                        <i class="bi bi-eye-fill me-1"></i>{{ number_format($article->views) }}x dilihat
                                    </p>
                                </div>

                                <!-- Tombol Like -->
                                @php
                                    $liked =
                                        session()->has('liked_article_' . $article->id) &&
                                        now()->lt(session('liked_article_' . $article->id));
                                @endphp

                                <form action="{{ route('articles.like', $article->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-danger btn-sm" type="submit"
                                        {{ $liked ? 'disabled' : '' }}>
                                        ❤️ {{ $article->likes ?? 0 }}
                                    </button>
                                </form>
                            </div>

                            {{-- Deskripsi --}}
                            <p class="card-text">{{ Str::limit($article->description, 100) }}</p>

                            {{-- Audio --}}
                            @if ($article->audio)
                                <audio controls class="w-100 mb-2">
                                    <source src="{{ asset('storage/' . $article->audio) }}">
                                </audio>
                            @endif

                            <!-- Tombol hanya Lihat untuk semua user -->
                            <div class="d-flex justify-content-between gap-2 mt-auto">
                                <a href="{{ route('articles.show', $article->id) }}"
                                    class="btn btn-primary btn-sm flex-fill">Lihat</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada artikel tersedia.</p>
            @endforelse
        </div>
    </div>

    <style>
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .text-muted {
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .card-title {
                font-size: 1.1rem;
            }
        }
    </style>
@endsection
