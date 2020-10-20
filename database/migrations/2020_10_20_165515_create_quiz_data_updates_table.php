<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizDataUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_data_updates', function (Blueprint $table) {
            $table->id();
            $table->integer('difficultyId')->unsigned();
            $table->integer('categoryId')->unsigned();
            $table->text('response');
            $table->integer('statusCode');
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
        Schema::dropIfExists('quiz_data_updates');
    }
}
