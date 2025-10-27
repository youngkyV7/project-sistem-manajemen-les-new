<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Data absensi
            $table->string('status')->default('Hadir'); // status absen
            $table->timestamp('waktu_absen')->useCurrent(); // waktu absen
            $table->date('tanggal')->default(DB::raw('CURRENT_DATE')); // tanggal absensi (bisa dipakai untuk whereDate)

            // Pastikan 1 user hanya bisa absen sekali per hari
            $table->unique(['user_id', 'tanggal']);


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
