<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        Schema::create('cabangs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alamat');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamps();
        });


        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role'); 
            $table->string('no_telp')->nullable();
            $table->foreignId('cabang_id')->nullable()->constrained('cabangs')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('perangkats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('cabang_id')->constrained('cabangs')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('perangkat_id')->constrained('perangkats')->onDelete('cascade');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->string('status')->default('ongoing');
            $table->string('photo_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('billings');
        Schema::dropIfExists('perangkats');
        Schema::dropIfExists('users');
        Schema::dropIfExists('cabangs');
    }
};
