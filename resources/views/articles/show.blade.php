@php
    use Illuminate\Support\Str;

    $imagePath = storage_path('app/public/' . $article->photo);
    $limit = 1106; // default

    if (file_exists($imagePath)) {
        $size = getimagesize($imagePath);
        $width = $size[0];
        $height = $size[1];

        if ($height > $width) {
            // Jika foto potret
            $limit = 1860; //2562
        }
    }

    $descTop = Str::substr($article->description, 0, $limit);
    $descBottom = Str::substr($article->description, $limit);
@endphp


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="custom-grid-layout">
            {{-- Kolom Kiri: Gambar & Audio --}}
            <div id="mediaColumn">
                @if ($article->photo)
                    <img src="{{ asset('storage/' . $article->photo) }}" alt="Photo" class="img-fluid d-block mx-auto"
                        style="max-width: 100%; height: auto; object-fit: contain;">
                @endif

                @if ($article->audio)
                    <audio controls class="w-100 mt-2">
                        <source src="{{ asset('storage/' . $article->audio) }}">
                        Browser Anda tidak mendukung audio.
                    </audio>
                @endif
            </div>

            {{-- Kolom Kanan: Teks bagian atas --}}
            <div id="textColumnTop">
                <h2 class="fw-bold text-primary shifted-title">{{ $article->title }}</h2>

                {{-- Paragraf awal --}}
                <div class="article-description">
                    {!! nl2br(e($descTop)) !!}
                </div>
            </div>

            {{-- Kolom bawah: lanjutan teks --}}
            <div id="textColumnBottom">
                <div class="article-description">
                    {!! nl2br(e($descBottom)) !!}
                </div>
                <a href="{{ route('articles.index') }}"
                    class="btn btn-outline-primary mt-3 px-4 d-block mx-auto rounded-pill btn-back-small">
                    ← Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <style>
        .shifted-title {
            text-align: center;
        }

        .custom-grid-layout {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        #mediaColumn,
        #textColumnTop {
            flex: 1;
            min-width: 300px;
        }

        #mediaColumn {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        #textColumnTop {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .article-description {
            text-align: justify;
            font-size: 1.2rem;
            line-height: 1.6;
            flex: 1;
            overflow-y: auto;
        }

        .btn-back-small {
            max-width: 250px;
            text-align: center;
        }



        @media (max-width: 767.98px) {
            .custom-grid-layout {
                display: block;
            }

            #mediaColumn,
            #textColumnTop,
            #textColumnBottom {
                width: 100%;
            }
        }
    </style>
@endsection



{{-- @php
    use Illuminate\Support\Str;

    $limit = 2562; // batas karakter awal
    $descTop = Str::substr($article->description, 0, $limit);
    $descBottom = Str::substr($article->description, $limit);
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="custom-flex-layout">
         Kolom Kiri: Gambar dan Audio
        <div id="mediaColumn">
            @if ($article->photo)
                <img src="{{ asset('storage/' . $article->photo) }}" alt="Photo"
                    class="img-fluid d-block mx-auto"
                    style="max-width: 100%; height: auto; object-fit: contain;">
            @endif

            @if ($article->audio)
                <audio controls class="w-100 mt-3">
                    <source src="{{ asset('storage/' . $article->audio) }}">
                    Browser Anda tidak mendukung audio.
                </audio>
            @endif
        </div>

        Kolom Kanan: Judul & Deskripsi Awal
        <div id="textColumnTop">
            <h2 class="fw-bold text-primary text-center">{{ $article->title }}</h2>
            <div class="article-description">
                {!! nl2br(e($descTop)) !!}
            </div>
        </div>
    </div>

    Kolom Bawah: Lanjutan Deskripsi
    <div id="textColumnBottom" class="mt-4">
        <div class="article-description">
            {!! nl2br(e($descBottom)) !!}
        </div>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary mt-3 w-100">Kembali ke Daftar</a>
    </div>
</div>
@endsection

@section('styles')
<style>
    .custom-flex-layout {
        display: flex;
        gap: 20px;
        align-items: stretch;
        flex-wrap: wrap;
    }

    #mediaColumn,
    #textColumnTop {
        flex: 1;
        min-width: 300px;
        background-color: #fff;
        padding: 10px;
        box-sizing: border-box;
    }

    .article-description {
        text-align: justify;
        font-size: 1.2rem;
        line-height: 1.6;
    }

    @media (max-width: 767.98px) {
        .custom-flex-layout {
            flex-direction: column;
        }

        #textColumnTop {
            height: auto !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    function equalizeHeight() {
        const mediaCol = document.getElementById('mediaColumn');
        const textCol = document.getElementById('textColumnTop');

        if (window.innerWidth > 768) {
            const mediaHeight = mediaCol.offsetHeight;
            textCol.style.height = mediaHeight + 'px';
        } else {
            textCol.style.height = 'auto';
        }
    }

    window.addEventListener('load', equalizeHeight);
    window.addEventListener('resize', equalizeHeight);
</script>
@endsection --}}
