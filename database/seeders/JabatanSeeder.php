<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatans')->insert([
            [
                'id_jabatan' => 1,
                'nama_jabatan' => 'Staff IT',
                'gaji_pokok' => 3000000,
            ],
            [
                'id_jabatan' => 2,
                'nama_jabatan' => 'Programmer',
                'gaji_pokok' => 4000000,
            ],
            [
                'id_jabatan' => 3,
                'nama_jabatan' => 'Senior Programmer',
                'gaji_pokok' => 6000000,
            ],
            [
                'id_jabatan' => 4,
                'nama_jabatan' => 'Manager IT',
                'gaji_pokok' => 8000000,
            ],
        ]);
    }
}
