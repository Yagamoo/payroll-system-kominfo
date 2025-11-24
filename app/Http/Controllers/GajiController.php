<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Presensi;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil bulan dari request, atau default bulan ini
        $bulan = request('bulan') ?? date('Y-m');

        // Pisahkan jadi year & month
        [$year, $month] = explode('-', $bulan);

        $pegawais = Pegawai::select(
            'pegawais.id_pegawai',
            'pegawais.nama',
            'pegawais.gelar',
            'jabatans.nama_jabatan',
            'jabatans.gaji_pokok'
        )
            ->leftJoin('jabatans', 'jabatans.id_jabatan', '=', 'pegawais.id_jabatan')
            ->leftJoin('presensis', function ($join) use ($year, $month) {
                $join->on('presensis.id_pegawai', '=', 'pegawais.id_pegawai')
                    ->whereYear('presensis.tanggal', $year)
                    ->whereMonth('presensis.tanggal', $month);
            })
            ->selectRaw("
            (SUM(CASE WHEN presensis.status_hadir = 'alpa' THEN 1 ELSE 0 END) * 100000
             + SUM(presensis.terlambat_menit) * 2000) as total_potongan
        ")
            ->selectRaw("SUM(presensis.lembur_menit) * 1000 as total_lembur")
            ->selectRaw("
            jabatans.gaji_pokok 
            - (SUM(CASE WHEN presensis.status_hadir = 'alpa' THEN 1 ELSE 0 END) * 100000
               + SUM(presensis.terlambat_menit) * 2000)
            + (SUM(presensis.lembur_menit) * 1000) 
            as gaji_bersih
        ")
            ->groupBy('pegawais.id_pegawai')
            ->orderByRaw("
            CASE 
                WHEN gelar = 'D3' THEN 1
                WHEN gelar = 'S1' THEN 2
                WHEN gelar = 'S2' THEN 3
                ELSE 4
            END
        ")
            ->get();

        return view('gaji.index', compact('pegawais', 'bulan'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data pegawai + jabatan
        $pegawai = Pegawai::with('jabatan')->findOrFail($id);

        // Hitung potongan alpa
        $potongan_alpa = Presensi::where('id_pegawai', $id)
            ->where('status_hadir', 'alpa')
            ->count() * 100000;

        // Hitung potongan terlambat
        $potongan_terlambat = Presensi::where('id_pegawai', $id)
            ->sum('terlambat_menit') * 2000;

        $total_potongan = $potongan_alpa + $potongan_terlambat;

        // Hitung total lembur
        $total_lembur = Presensi::where('id_pegawai', $id)
            ->sum('lembur_menit') * 1000;

        // Gaji pokok dari jabatan
        $gaji_pokok = $pegawai->jabatan->gaji_pokok;

        // Hitung gaji bersih
        $gaji_bersih = $gaji_pokok - $total_potongan + $total_lembur;

        return view('gaji.show', compact(
            'pegawai',
            'gaji_pokok',
            'total_potongan',
            'total_lembur',
            'gaji_bersih'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
