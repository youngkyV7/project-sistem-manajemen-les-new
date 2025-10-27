<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('karya_siswa', function (Blueprint $table) {
            $table->dropColumn('link_repo'); // hapus kolom link_repo
        });
    }

    public function down(): void
    {
        Schema::table('karya_siswa', function (Blueprint $table) {
            $table->string('link_repo')->nullable(); // kembalikan kolom jika rollback
        });
    }
};
