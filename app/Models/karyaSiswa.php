<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KaryaSiswa extends Model
{
    protected $table = 'karya_siswa';

    protected $fillable = [
        'siswa_id',
        'judul',
        'deskripsi',
        'gambar',
        'link_demo',
        'link_repo',
        'view',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
