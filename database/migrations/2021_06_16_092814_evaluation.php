<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Evaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluationcategory', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('fypsession');
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('evaluationchild', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('titleid');
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('evaluationmarking', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('parentid');
            $table->string('marks');
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('evaluationbysupervisor', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('evaluationmarkingid');
            $table->string('supervisorid');
            $table->string('studentid');
            $table->float('marksgiven');
            $table->timestamps();
        });

        Schema::create('evaluationbyexaminer', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('evaluationmarkingid');
            $table->string('examinerid');
            $table->string('studentid');
            $table->float('marksgiven');
            $table->timestamps();
        });
        Schema::create('evaluationfinal', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('evaluationbysupervisorid');
            $table->string('evaluationbyexaminerid');
            $table->string('supervisorid');
            $table->string('examinerid');
            $table->string('studentid');
            $table->float('total');
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
        //
    }
}
