<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('karya_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // judul karya
            $table->text('deskripsi')->nullable(); // deskripsi karya
            $table->string('file')->nullable(); // file atau gambar karya
            $table->unsignedBigInteger('user_id')->nullable(); // id siswa
            $table->timestamps();

            // relasi opsional ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('karya_siswa');
    }
};
