<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('penerbit');
            $table->string('tahun');
            $table->text('sinopsis');
            $table->string('cover');
            $table->string('genre');
            $table->string('stok');
            $table->string('stok_now');
            $table->unsignedBigInteger('rak_id');

            $table->foreign('rak_id')->references('id')->on('raks');
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
        Schema::dropIfExists('books');
    }
}
