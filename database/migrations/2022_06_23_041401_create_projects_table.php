<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('id_project');
            $table->unsignedBigInteger('id_user');
            $table->string('no_order')->unique()->nullable();
            $table->string('project_name');
            $table->string('project_location');
            $table->string('pic');
            $table->string('company_name');
            $table->string('company_address');
            $table->string('file')->nullable();
            $table->string('current_step')->nullable();
            $table->enum('status', ['accept', 'process']);
            $table->date('accepted_at')->nullable();
            $table->date('estimated_opened')->nullable();
            $table->timestamps();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
