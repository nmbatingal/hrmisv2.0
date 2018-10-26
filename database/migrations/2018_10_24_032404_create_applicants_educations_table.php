<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('program');
            $table->string('school');
            $table->date('yearGraduated');
            $table->uuid('applicant_id');
            $table->timestamps();

            $table->foreign('applicant_id')->references('id')->on('applicants_infos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants_educations');
    }
}
