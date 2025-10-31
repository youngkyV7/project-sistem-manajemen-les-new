<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->boolean('is_delete')->default(false)->after('foto_siswa');
        });

        Schema::table('karya_siswa', function (Blueprint $table) {
            $table->boolean('is_delete')->default(false)->after('view');
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('is_delete');
        });

        Schema::table('karya_siswa', function (Blueprint $table) {
            $table->dropColumn('is_delete');
        });
    }
};
