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
            'email' => 'brett@brett.com' ,
            'email' => 'yb@yb.com'
        ], [
            'name' => 'Brett',
            'password' => bcrypt('sayaBret') ,
            'name' => 'yb',
            'password' => bcrypt('yb03012012')
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
