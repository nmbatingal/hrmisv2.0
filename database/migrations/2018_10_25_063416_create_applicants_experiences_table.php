<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql3')->create('applicants_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agency');
            $table->string('position')->nullable();
            $table->decimal('salaryGrade', 10, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::connection('mysql3')->dropIfExists('applicants_experiences');
    }
}
