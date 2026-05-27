<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabtestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labtest', function (Blueprint $table) {
            $table->id('id_labtest');
            $table->unsignedBigInteger('id_order')->unique();
            $table->integer('selesai_qty');
            $table->text('catatan');
            $table->timestamps();
        });

        Schema::table('labtest', function (Blueprint $table) {
            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labtest');
    }
}
