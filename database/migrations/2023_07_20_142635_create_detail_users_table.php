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
        Schema::create('detail_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nama_pemilih')->nullable();
            $table->uuid('kelas_id')->nullable();
            $table->foreign('kelas_id')->references('id_kelas')->on('kelas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('prodi_id')->nullable();
            $table->foreign('prodi_id')->references('id_prodi')->on('prodis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('tahun_ajar_id')->nullable();
            $table->foreign('tahun_ajar_id')->references('id_tahun_ajar')->on('tahun_ajars')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_users');
    }
};
