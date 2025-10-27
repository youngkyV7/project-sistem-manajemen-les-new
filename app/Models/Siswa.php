<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'id_siswa',
        'nama_siswa',
        'no_hp',
        'pendidikan',
        'alamat',
        'kota',
        'foto_siswa',
    ];

    // ✅ Relasi ke tabel absensis
    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'siswa_id');
    }
}
