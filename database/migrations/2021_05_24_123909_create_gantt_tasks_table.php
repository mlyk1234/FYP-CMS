<?php
 
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('gantttasks', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('text');
            $table->integer('duration');
            $table->float('progress');
            $table->dateTime('start_date');
            $table->integer('parent');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('gantttasks');
    }
}