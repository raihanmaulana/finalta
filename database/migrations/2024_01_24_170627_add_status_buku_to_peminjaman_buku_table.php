<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusBukuToPeminjamanBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman_buku', function (Blueprint $table) {
            $table->boolean('status_buku')->default(true); // Gantilah tipe data sesuai kebutuhan
        });
    }

    public function down()
    {
        Schema::table('peminjaman_buku', function (Blueprint $table) {
            $table->dropColumn('status_buku');
        });
    }
}
