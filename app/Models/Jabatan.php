<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $primaryKey = 'id_jabatan';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama_jabatan', 'gaji_pokok'];
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
