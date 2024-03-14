<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('isbn');
            $table->string('judul_buku');
            $table->string('penerbit');
            $table->string('pengarang');
            $table->integer('tahun_terbit');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('kategoribuku');
            $table->integer('added_by');
            $table->integer('stok');
            $table->string('image')->nullable();
            $table->boolean('tersedia')->default(false); // Menambahkan nilai default
            $table->tinyInteger('kondisi'); // Mengubah tipe data menjadi tinyInteger
            $table->string('tautan_buku')->nullable();
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}
