<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'web'; // Gunakan guard default Laravel

        // ✅ Buat role admin & siswa jika belum ada
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => $guard,
        ]);

        $siswaRole = Role::firstOrCreate([
            'name' => 'siswa',
            'guard_name' => $guard,
        ]);

        // ✅ Buat beberapa akun admin
        $admins = [
            [
                'name' => 'Brett',
                'email' => 'brett@brett.com',
                'password' => bcrypt('sayaBret'),
            ],
            [
                'name' => 'Rio',
                'email' => 'rio@rio.com',
                'password' => bcrypt('rio123'),
            ],
            [
                'name' => 'YB',
                'email' => 'yb@yb.com',
                'password' => bcrypt('yb03012012'),
            ],
        ];

        foreach ($admins as $data) {
            $admin = User::firstOrCreate(
                ['email' => $data['email']], // kunci unik
                $data // isi data baru
            );

            if (!$admin->hasRole('admin')) {
                $admin->assignRole($adminRole);
            }
        }

        // ✅ Buat akun siswa contoh
        $siswa = User::firstOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name' => 'Siswa Contoh',
                'password' => bcrypt('password'),
            ]
        );

        if (!$siswa->hasRole('siswa')) {
            $siswa->assignRole($siswaRole);
        }
    }
}
