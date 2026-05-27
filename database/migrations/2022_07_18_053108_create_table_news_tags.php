<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNewsTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_tags', function (Blueprint $table) {
            $table->id('id_news_tag');
            $table->unsignedBigInteger('id_news');
            $table->unsignedBigInteger('id_tag');
            $table->timestamps();
        });

        Schema::table('news_tags', function (Blueprint $table) {
            $table->foreign('id_news')->references('id_news')->on('news')->onDelete('cascade');
            $table->foreign('id_tag')->references('id_tag')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_tags');
    }
}
