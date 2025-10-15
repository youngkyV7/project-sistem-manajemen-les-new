<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'guest'
        ]);

        $user = User::create([
            'name' => 'Brett',
            'email' => 'brett@brett.com',
            'password' => bcrypt('sayaBret')
        ]);

        $user->assignRole($ownerRole);
    }
}
