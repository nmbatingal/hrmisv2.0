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
        Schema::connection('mysql2')->create('document_trackers', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 20)->nullable()->unique();
            $table->string('tracking_code')->nullable()->unique();
            $table->uuid('employee_id');
            $table->integer('doc_type_id')->unsigned()->nullable();
            $table->string('subject')->nullable();
            $table->text('details')->nullable();
            $table->string('keywords')->nullable();
            $table->string('attachments')->nullable();
            $table->date('document_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('employee_id')->references('id')->on('hrmis.users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('doc_type_id')->references('id')->on('doctracker.document_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('document_trackers');
    }
}
