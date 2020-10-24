<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateQuizDataUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_data_updates', function (Blueprint $table) {
            $table->integer('newQuestions')->after('statusCode');
            $table->integer('deletedQuestions')->after('newQuestions');
            $table->dropColumn('response');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_data_updates', function (Blueprint $table) {
            $table->dropColumn('newQuestions');
            $table->dropColumn('deletedQuestions');
            $table->text('response');
        });
    }
}
