<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
    {
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('id_siswa');
            $table->string('nama_siswa');
            $table->string('no_hp');
            $table->string('pendidikan');
            $table->string('alamat');
            $table->string('kota');
            $table->string('foto_siswa')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
