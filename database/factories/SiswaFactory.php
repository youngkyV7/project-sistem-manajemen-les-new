<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition()
    {
        $tahun_bulan = date('Ym');
        static $count = 1;
        $id_siswa = $tahun_bulan . str_pad($count++, 4, '0', STR_PAD_LEFT);

        return [
            'id_siswa' => $id_siswa,
            'nama_siswa' => $this->faker->name(),
            'no_hp' => $this->faker->phoneNumber(),
            'pendidikan' => 'SMA',
            'kelas' => 'X',
            'alamat' => $this->faker->address(),
            'kota' => $this->faker->city(),
            'foto_siswa' => null,
            'is_delete' => false,
        ];
    }
}
