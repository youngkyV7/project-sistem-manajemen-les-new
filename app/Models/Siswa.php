<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Siswa extends Authenticatable
{
    use HasRoles;

    protected $guard_name = 'siswa';
    protected $fillable = ['name', 'email', 'password'];
}
