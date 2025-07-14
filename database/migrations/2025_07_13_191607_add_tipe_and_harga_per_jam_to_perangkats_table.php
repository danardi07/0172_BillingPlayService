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
    Schema::table('perangkats', function (Blueprint $table) {
        $table->string('tipe')->nullable();
        $table->integer('harga_per_jam')->nullable();
    });
}

public function down(): void
{
    Schema::table('perangkats', function (Blueprint $table) {
        $table->dropColumn(['tipe', 'harga_per_jam']);
    });
}

};
