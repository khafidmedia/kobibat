@csrf

<div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control" id="nama" name="nama" 
           value="{{ old('nama', $pendaftaran->nama ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" 
           value="{{ old('email', $pendaftaran->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="telepon" class="form-label">Telepon</label>
    <input type="text" class="form-control" id="telepon" name="telepon" 
           value="{{ old('telepon', $pendaftaran->telepon ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pendaftaran->alamat ?? '') }}</textarea>
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">Kembali</a>
</div>