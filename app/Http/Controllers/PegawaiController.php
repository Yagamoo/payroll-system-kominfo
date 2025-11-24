<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = Pegawai::orderByRaw("
            CASE 
                WHEN gelar = 'D3' THEN 1
                WHEN gelar = 'S1' THEN 2
                WHEN gelar = 'S2' THEN 3
                ELSE 4
            END
        ")->get();

        return view('pegawai.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = Jabatan::all();
        return view('pegawai.create', compact('jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'gelar' => 'required',
            'id_jabatan' => 'required|exists:jabatans,id_jabatan'
        ]);

        Pegawai::create([
            'nama' => $request->nama,
            'gelar' => $request->gelar,
            'id_jabatan' => $request->id_jabatan
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $jabatans = Jabatan::all();

        return view('pegawai.edit', compact('pegawai', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'gelar' => 'required',
            'id_jabatan' => 'required|exists:jabatans,id_jabatan'
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update([
            'nama' => $request->nama,
            'gelar' => $request->gelar,
            'id_jabatan' => $request->id_jabatan
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus');
    }
}
