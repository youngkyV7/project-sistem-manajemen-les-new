<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHasilBelajar extends Model
{
    use HasFactory;

    protected $table = 'laporan_hasil_belajar'; // ✅ TANPA "s"

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'hasil',
        'catatan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
