<?php

use App\Models\Organisasi;
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
        Schema::create('kandidats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organisasi::class)->constrained('organisasis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('ketua');
            $table->string('wakil');
            $table->text('visi');
            $table->text('misi');
            $table->string('periode');
            $table->uuid('kelas_ketua_id');
            $table->foreign('kelas_ketua_id')->references('id_kelas')->on('kelas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('kelas_wakil_id');
            $table->foreign('kelas_wakil_id')->references('id_kelas')->on('kelas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('prodi_ketua_id');
            $table->foreign('prodi_ketua_id')->references('id_prodi')->on('prodis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('prodi_wakil_id');
            $table->foreign('prodi_wakil_id')->references('id_prodi')->on('prodis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('foto');
            $table->string('foto_ketua');
            $table->string('foto_wakil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kandidats');
    }
};
