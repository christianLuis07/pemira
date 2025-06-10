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
        Schema::table('organisasis', function (Blueprint $table) {
            $table->datetime('start')->after('name');
            $table->datetime('end')->after('start');
            $table->boolean('active')->after('end')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organisasis', function (Blueprint $table) {
            //
        });
    }
};
