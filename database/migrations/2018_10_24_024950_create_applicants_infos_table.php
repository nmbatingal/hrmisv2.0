<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql3')->create('applicants_infos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->integer('sex')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('age')->nullable();
            $table->char('contactNumber', 20)->nullable();
            $table->string('email')->nullable();
            $table->text('homeAddress')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('hireStatus')->default(0); // 0 - not yet hired; 1 - hired
            $table->integer('interviewStatus')->default(0); // 0 - not yet interviewed; 1 - interviewed
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql3')->dropIfExists('applicants_infos');
    }
}
