<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_doctracker')->create('document_trackers', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 20)->primary();
            $table->string('tracking_code')->primary();
            $table->uuid('employee_id');
            $table->integer('document_type')->nullable();
            $table->string('document_name')->nullable();
            $table->text('details')->nullable();
            $table->date('document_date')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('hrmis.users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('document_type')->references('id')->on('doctracker.document_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_doctracker')->dropIfExists('document_trackers');
    }
}
