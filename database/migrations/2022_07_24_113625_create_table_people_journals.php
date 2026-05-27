<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePeopleJournals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_journals', function (Blueprint $table) {
            $table->id('id_people_journals');
            $table->bigInteger('id_people')->unsigned();
            $table->bigInteger('id_journal')->unsigned();
            $table->timestamps();
        });

        Schema::table('people_journals', function (Blueprint $table) {
            $table->foreign('id_people')->references('id_people')->on('people')->onDelete('cascade');
            $table->foreign('id_journal')->references('id_journal')->on('journals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people_journals');
    }
}
