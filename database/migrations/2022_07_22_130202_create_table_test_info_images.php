<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTestInfoImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_info_image', function (Blueprint $table) {
            $table->id('id_test_info_image');
            $table->bigInteger('id_test_info')->unsigned();
            $table->string('image');
            $table->timestamps();
        });

        Schema::table('test_info_image', function (Blueprint $table) {
            $table->foreign('id_test_info')->references('id_test_info')->on('test_info')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_info_images');
    }
}
