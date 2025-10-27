<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('karya_siswa', function (Blueprint $table) {
            $table->string('kategori', 100)->after('judul')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('karya_siswa', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};
