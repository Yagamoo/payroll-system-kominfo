<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawais')->insert([
            [
                'id_pegawai' => 1,
                'nama' => 'Andi Pratama',
                'gelar' => 'S1',
                'id_jabatan' => 2,
            ],
            [
                'id_pegawai' => 2,
                'nama' => 'Budi Hartono',
                'gelar' => 'D3',
                'id_jabatan' => 1,
            ],
            [
                'id_pegawai' => 3,
                'nama' => 'Clara Wijaya',
                'gelar' => 'S2',
                'id_jabatan' => 3,
            ],
            [
                'id_pegawai' => 4,
                'nama' => 'Dian Novita',
                'gelar' => 'S1',
                'id_jabatan' => 4,
            ],
            [
                'id_pegawai' => 5,
                'nama' => 'Taufik Hidayat',
                'gelar' => 'D3',
                'id_jabatan' => 1,
            ],
        ]);
    }
}
