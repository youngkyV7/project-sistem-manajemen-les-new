<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: tambahkan kolom siswa_id, tanggal, hasil, dan catatan.
     */
    public function up(): void
    {
        Schema::table('laporan_hasil_belajar', function (Blueprint $table) {
            // Tambahkan kolom siswa_id (relasi ke tabel siswas)
            if (!Schema::hasColumn('laporan_hasil_belajar', 'siswa_id')) {
                $table->unsignedBigInteger('siswa_id')->after('id');
                $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            }

            // Tambahkan kolom tanggal
            if (!Schema::hasColumn('laporan_hasil_belajar', 'tanggal')) {
                $table->date('tanggal')->after('siswa_id');
            }

            // Tambahkan kolom hasil
            if (!Schema::hasColumn('laporan_hasil_belajar', 'hasil')) {
                $table->enum('hasil', ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'])->after('tanggal');
            }

            // Tambahkan kolom catatan
            if (!Schema::hasColumn('laporan_hasil_belajar', 'catatan')) {
                $table->text('catatan')->nullable()->after('hasil');
            }
        });
    }

    /**
     * Batalkan perubahan migrasi.
     */
    public function down(): void
    {
        Schema::table('laporan_hasil_belajar', function (Blueprint $table) {
            // Hapus relasi & kolom siswa_id
            if (Schema::hasColumn('laporan_hasil_belajar', 'siswa_id')) {
                $table->dropForeign(['siswa_id']);
                $table->dropColumn('siswa_id');
            }

            // Hapus kolom lainnya
            foreach (['tanggal', 'hasil', 'catatan'] as $col) {
                if (Schema::hasColumn('laporan_hasil_belajar', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
