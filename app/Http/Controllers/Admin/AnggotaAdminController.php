<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaAdminController extends Controller
{
    /**
     * Tampilkan semua data anggota.
     */
    public function index()
    {
        $anggotas = Anggota::all();
        return view('admin.kas_masuk.index', compact('anggotas'));
    }

   

    public function create()
    {
        return view('admin.kas_masuk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'nominal' => 'required|numeric|min:0',
        ]);

        Anggota::create($request->only(['nama', 'no_hp', 'alamat', 'status', 'nominal']));

        return redirect()->route('admin.kas_masuk.index')->with('success', 'Anggota ditambahkan');
    }

    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('admin.kas_masuk.show', compact('anggota'));
    }

    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('admin.kas_masuk.edit', compact('anggota'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'nominal' => 'required|numeric|min:0',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update($request->only(['nama', 'no_hp', 'alamat', 'status', 'nominal']));

        return redirect()->route('admin.kas_masuk.index')->with('success', 'Anggota diperbarui');
    }

    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('admin.kas_masuk.index')->with('success', 'Anggota dihapus');
    }
}
