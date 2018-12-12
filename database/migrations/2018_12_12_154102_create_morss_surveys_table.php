<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMorssSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql4')->create('morss_surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('semester_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('rate')->nullable();
            $table->timestamps();

            $table->foreign('semester_id')->references('id')->on('morale_survey.morss_semesters')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('dost13.users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('morale_survey.morss_questions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql4')->dropIfExists('morss_surveys');
    }
}
