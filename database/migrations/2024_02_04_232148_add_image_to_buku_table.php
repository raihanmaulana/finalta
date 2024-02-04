<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->string('image')->nullable(); // Kolom gambar
        });
    }

    public function down()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
