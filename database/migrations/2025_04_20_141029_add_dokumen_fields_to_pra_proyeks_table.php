<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDokumenFieldsToPraProyeksTable extends Migration
{
    public function up()
    {
        Schema::table('pra_proyeks', function (Blueprint $table) {
            $table->json('dokumen')->nullable()->after('tanggal_usulan');
            $table->enum('status_dokumen', ['ada', 'belum'])->default('belum')->after('dokumen');
            $table->enum('keterangan_status', ['lengkap', 'belum'])->default('belum')->after('status_dokumen');
        });
    }

    public function down()
    {
        Schema::table('pra_proyeks', function (Blueprint $table) {
            $table->dropColumn(['dokumen', 'status_dokumen', 'keterangan_status']);
        });
    }
}
