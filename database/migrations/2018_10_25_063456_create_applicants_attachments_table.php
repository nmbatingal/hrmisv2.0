<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql3')->create('applicants_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename')->nullable();
            $table->integer('filesize')->nullable();
            $table->string('filepath')->nullable();
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
        Schema::connection('mysql3')->dropIfExists('applicants_attachments');
    }
}
