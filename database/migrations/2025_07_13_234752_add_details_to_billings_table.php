<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToBillingsTable extends Migration
{
    public function up()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->string('nama_pelanggan')->nullable();
            $table->string('jenis_pembayaran')->nullable();
            $table->integer('durasi')->nullable();
        });
    }

    public function down()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->dropColumn(['nama_pelanggan', 'jenis_pembayaran', 'durasi']);
        });
    }
}

