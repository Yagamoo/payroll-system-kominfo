<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $rolePegawai = Role::firstOrCreate(['name' => 'pegawai']);

        // ===== CREATE USERS =====
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Sistem',
                'password' => Hash::make('password'),
            ]
        );

        $pegawai = User::firstOrCreate(
            ['email' => 'pegawai@example.com'],
            [
                'name' => 'Pegawai Satu',
                'password' => Hash::make('password'),
            ]
        );

        // ===== ASSIGN ROLES =====
        $admin->assignRole('admin');
        $pegawai->assignRole('pegawai');

        $this->call([
            JabatanSeeder::class,
            PegawaiSeeder::class,
            PresensiSeeder::class
        ]);
    }
}
