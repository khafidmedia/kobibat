@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Pendaftaran</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pendaftaran.store') }}" method="POST">
                @csrf
                @include('admin.pendaftaran.form')
            </form>
        </div>
    </div>
</div>
@endsection