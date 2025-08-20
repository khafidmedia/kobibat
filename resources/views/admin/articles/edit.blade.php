@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Edit Artikel</h3>

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <input class="form-control mb-2" type="text" name="title" value="{{ $article->title }}" required>
        <textarea class="form-control mb-2" name="description" rows="4" required>{{ $article->description }}</textarea>

        <label>Foto Lama:</label><br>
        @if ($article->photo)
            <img src="{{ asset('storage/' . $article->photo) }}" width="200" class="mb-2"><br>
        @endif
        <input class="form-control mb-2" type="file" name="photo">

        <label>Audio Lama:</label><br>
        @if ($article->audio)
            <audio controls class="mb-2">
                <source src="{{ asset('storage/' . $article->audio) }}">
            </audio><br>
        @endif
        <input class="form-control mb-3" type="file" name="audio">

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
