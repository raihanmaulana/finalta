<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsernameToAnggotaPerpustakaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anggota_perpustakaan', function (Blueprint $table) {
            $table->string('username')->unique()->after('nomor_anggota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anggota_perpustakaan', function (Blueprint $table) {
            //
        });
    }
}
