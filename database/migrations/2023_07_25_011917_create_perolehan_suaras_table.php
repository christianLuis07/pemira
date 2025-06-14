<?php

use App\Models\Kandidat;
use App\Models\Organisasi;
use App\Models\User;
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
        Schema::create('perolehan_suaras', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Organisasi::class)->constrained('organisasis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Kandidat::class)->constrained('kandidats')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perolehan_suaras');
    }
};
