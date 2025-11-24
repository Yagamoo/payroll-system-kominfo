<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presensis = Presensi::all();
        return view('presensi.index', compact('presensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawais = Pegawai::all();
        return view('presensi.create', compact('pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pegawai' => 'required',
            'tanggal' => 'required|date',
            'status_hadir' => 'required|in:hadir,alpa',
            'jam_masuk' => 'nullable',
            'jam_keluar' => 'nullable',
        ]);

        // Hitung ulang keterlambatan
        $jamMasukNormal = now()->parse('09:00:00');
        $jamMasuk = now()->parse($request->jam_masuk);

        $terlambat = 0;
        if ($request->status_hadir === 'hadir') {
            $diff = $jamMasukNormal->diffInMinutes($request->jam_masuk, false);
            $terlambat = abs($diff);
        }

        // Hitung ulang lembur
        $jamKeluarNormal = now()->parse('17:00:00');
        $jamKeluar = now()->parse($request->jam_keluar);

        $lembur = 0;
        if ($request->status_hadir === 'hadir') {
            $diff = $jamKeluarNormal->diffInMinutes($request->jam_keluar, false);
            $lembur = abs($diff);
        }

        Presensi::create([
            'id_pegawai' => $request->id_pegawai,
            'tanggal' => $request->tanggal,
            'status_hadir' => $request->status_hadir,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'jam_masuk_normal' => $jamMasukNormal,
            'jam_keluar_normal' => $jamKeluarNormal,
            'terlambat_menit' => $terlambat,
            'lembur_menit' => $lembur,
        ]);

        return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil ditambahkan');
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
        $presensi = Presensi::findOrFail($id);
        $pegawais = Pegawai::all();

        return view('presensi.edit', compact('presensi', 'pegawais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $presensi = Presensi::findOrFail($id);

        $request->validate([
            'id_pegawai' => 'required',
            'tanggal' => 'required|date',
            'status_hadir' => 'required|in:hadir,alpa',
            'jam_masuk' => 'nullable',
            'jam_keluar' => 'nullable',
        ]);

        // Hitung ulang keterlambatan
        $jamMasukNormal = now()->parse('09:00:00');
        $jamMasuk = now()->parse($request->jam_masuk);

        $terlambat = 0;
        if ($request->status_hadir === 'hadir') {
            $diff = $jamMasukNormal->diffInMinutes($request->jam_masuk, false);
            $terlambat = abs($diff);
        }

        // Hitung ulang lembur
        $jamKeluarNormal = now()->parse('17:00:00');
        $jamKeluar = now()->parse($request->jam_keluar);

        $lembur = 0;
        if ($request->status_hadir === 'hadir') {
            $diff = $jamKeluarNormal->diffInMinutes($request->jam_keluar, false);
            $lembur = abs($diff);
        }

        $presensi->update([
            'id_pegawai' => $request->id_pegawai,
            'tanggal' => $request->tanggal,
            'status_hadir' => $request->status_hadir,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'terlambat_menit' => $terlambat,
            'lembur_menit' => $lembur,
        ]);

        return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $presensi = Presensi::findOrFail($id);
        $presensi->delete();

        return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil dihapus');
    }

}
