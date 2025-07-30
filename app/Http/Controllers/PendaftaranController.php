<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $pendaftaran = Pendaftaran::when($keyword, function ($query, $keyword) {
            return $query->where('nama', 'like', "%$keyword%")
                         ->orWhere('email', 'like', "%$keyword%");
        })->get();

        return view('admin.pendaftaran.index', compact('pendaftaran', 'keyword'));
    }

    public function create()
    {
        return view('admin.pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pendaftarans',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        Pendaftaran::create($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        return view('admin.pendaftaran.edit', compact('pendaftaran'));
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pendaftarans,email,' . $pendaftaran->id,
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        $pendaftaran->update($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil dihapus');
    }
}