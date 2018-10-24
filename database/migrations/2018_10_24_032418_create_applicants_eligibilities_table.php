<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsEligibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants_eligibilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('licenseTitle');
            $table->string('licenseNumber');
            $table->year('rating');
            $table->uuid('examDate');
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
        Schema::dropIfExists('applicants_eligibilities');
    }
}
