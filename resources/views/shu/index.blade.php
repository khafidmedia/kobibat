@extends('layouts.template')

@section('content')
<div class="container py-5" style="background-color: #f7f9fb; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(135deg, #00b894, #00cec9);">
                    <h3 class="mb-0">Perhitungan SHU Koperasi</h3>
                    <small>Isi data berikut untuk menghitung Sisa Hasil Usaha</small>
                </div>
                <div class="card-body p-4" style="background-color: #ffffff;">
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('shu.hitung') }}" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama lengkap" required>
                            <label for="nama"> Nama Anggota</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="pendapatan" class="form-control" id="pendapatan" placeholder="Pendapatan" required>
                            <label for="pendapatan"> Total Pendapatan (Rp)</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="number" name="biaya" class="form-control" id="biaya" placeholder="Biaya" required>
                            <label for="biaya">Total Biaya (Rp)</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                 Hitung SHU
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted text-center small">
                    &copy; {{ date('Y') }} Koperasi Simpan Pinjam | SHU Calculator
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
