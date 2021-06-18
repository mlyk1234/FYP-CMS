<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectdata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('studentid');
            $table->string('project_title');
            $table->string('basic_skill');
            $table->string('problem_statement');
            $table->string('objective')->nullable();
            $table->string('project_outcome')->nullable();
            $table->string('project_description')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('examiner')->nullable();
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
        Schema::dropIfExists('projectdata');
    }
}
