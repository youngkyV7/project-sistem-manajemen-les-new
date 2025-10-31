<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaSiswa extends Model
{
    use HasFactory;

    protected $table = 'karya_siswa';

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'gambar',
        'siswa_id',
        'link_demo',
        'view',
        'is_delete',
    ];
    protected $casts = [
        'is_delete' => 'boolean',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
