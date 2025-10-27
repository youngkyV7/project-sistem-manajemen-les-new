<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'status',
        'tanggal',
        'waktu_absen',

    ];

    protected $dates = ['tanggal', 'waktu_absen'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
