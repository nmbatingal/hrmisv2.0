<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTrackerAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('doctracking_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doctracker_id')->unsigned()->nullable();
            $table->integer('tracklog_id')->unsigned()->nullable();
            $table->string('filename')->nullable();
            $table->string('filepath')->nullable();
            $table->integer('filesize')->nullable();
            $table->timestamps();

            $table->foreign('doctracker_id')->references('id')->on('doctracker.document_trackers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tracklog_id')->references('id')->on('doctracker.document_tracking_logs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('doctracking_attachments');
    }
}
