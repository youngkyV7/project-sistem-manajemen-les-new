<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyaSiswa extends Model
{
    use HasFactory;

    protected $table = 'karya_siswa';

    protected $fillable = [
        'user_id',      // siswa yang membuat karya
        'judul',        // judul karya
        'deskripsi',    // deskripsi singkat karya
        'gambar',       // path gambar karya (jika ada)
        'link_demo',    // link ke demo online (opsional)
        'link_repo',    // link ke repository GitHub (opsional)
    ];

    /**
     * Relasi ke model User (pembuat karya)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
