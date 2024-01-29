<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomorAnggotaToBukuDikembalikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buku_dikembalikan', function (Blueprint $table) {
            $table->string('nomor_anggota')->nullable();
        });
    }

    public function down()
    {
        Schema::table('buku_dikembalikan', function (Blueprint $table) {
            $table->dropColumn('nomor_anggota');
        });
    }
}
