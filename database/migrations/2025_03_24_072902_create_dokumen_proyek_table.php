<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokumen_proyek', function (Blueprint $table) {
            $table->string('id_dokumen')->primary(); // ID Dokumen unik
            $table->string('jenis_dokumen');         // Surat, Memo, dll
            $table->string('template_dokumen')->nullable(); // Path file template
            $table->string('approval')->nullable();         // Manajer, Direktur, dll
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_proyek');
    }
};
