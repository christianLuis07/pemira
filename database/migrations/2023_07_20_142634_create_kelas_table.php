<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->uuid('id_kelas')->primary();
            $table->uuid('prodi_id')->nullable();
            $table->foreign('prodi_id')->references('id_prodi')->on('prodis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nama_kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
