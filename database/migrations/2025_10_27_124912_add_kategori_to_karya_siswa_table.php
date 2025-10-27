<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::table('karya_siswa', function (Blueprint $table) {
            if (!Schema::hasColumn('karya_siswa', 'kategori')) {
                $table->string('kategori', 100)->nullable()->after('judul');
            }
        });
    }

    public function down(): void
    {
        Schema::table('karya_siswa', function (Blueprint $table) {
            if (Schema::hasColumn('karya_siswa', 'kategori')) {
                $table->dropColumn('kategori');
            }
        });
    }
};

