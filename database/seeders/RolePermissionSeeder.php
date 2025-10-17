<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'web'; // pastikan web

        // Buat role admin & siswa jika belum ada
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => $guard,
        ]);

        $siswaRole = Role::firstOrCreate([
            'name' => 'siswa',
            'guard_name' => $guard,
        ]);

        // Buat akun admin contoh
        $admin = User::firstOrCreate([
            'email' => 'eko@gmail.com'
        ], [
            'name' => 'eko',
            'password' => bcrypt('eko')
        ]);

        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

        // Buat akun siswa contoh
        $siswa = User::firstOrCreate([
            'email' => 'siswa@example.com'
        ], [
            'name' => 'Siswa Contoh',
            'password' => bcrypt('password')
        ]);

        if (!$siswa->hasRole('siswa')) {
            $siswa->assignRole($siswaRole);
        }
    }
}
