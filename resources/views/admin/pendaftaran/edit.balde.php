@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Edit Pendaftaran</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pendaftaran.form', ['pendaftaran' => $pendaftaran])
            </form>
        </div>
    </div>
</div>
@endsection