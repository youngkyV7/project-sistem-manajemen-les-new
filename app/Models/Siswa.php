<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'siswas';

    // Kolom yang bisa diisi
    protected $fillable = [
        'nama_siswa',
        'id_siswa',
        'no_hp',
        'kota',
        'alamat',
        'pendidikan'
    ];

}