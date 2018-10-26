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
            $table->string('licenseTitle')->nullable();
            $table->string('licenseNumber')->nullable();
            $table->double('rating', 5, 2)->nullable();
            $table->date('exam_date')->nullable();
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
