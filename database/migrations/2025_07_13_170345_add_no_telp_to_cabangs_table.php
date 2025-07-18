<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cabangs', function (Blueprint $table) {
            $table->string('no_telp')->nullable()->after('alamat');
        });
    }

    public function down()
    {
        Schema::table('cabangs', function (Blueprint $table) {
            $table->dropColumn('no_telp');
        });
    }

};
