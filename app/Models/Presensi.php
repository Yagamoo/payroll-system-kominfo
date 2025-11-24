<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $primaryKey = 'id_presensi';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_pegawai',
        'tanggal',
        'status_hadir',
        'jam_masuk',
        'jam_keluar',
        'jam_masuk_normal',
        'jam_keluar_normal',
        'terlambat_menit',
        'lembur_menit',
    ];
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
