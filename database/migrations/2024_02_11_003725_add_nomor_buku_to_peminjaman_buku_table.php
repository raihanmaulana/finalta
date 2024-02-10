<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomorBukuToPeminjamanBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman_buku', function (Blueprint $table) {
            $table->string('nomor_buku')->nullable()->after('id_buku');
        });
    }

    public function down()
    {
        Schema::table('peminjaman_buku', function (Blueprint $table) {
            $table->dropColumn('nomor_buku');
        });
    }
}
