<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTrackingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_doctracker')->create('document_tracking_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tracking_code');
            $table->enum('action', ['forwarded', 'received', 'closed', 'cancelled'])->nullable();
            $table->uuid('employee_id')->nullable();
            $table->uuid('addressee_id')->nullable();
            $table->text('remarks')->nullable();
            $table->text('attachment')->nullable();
            $table->timestamps();

            $table->foreign('tracking_code')->references('id')->on('document_trackers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('hrmis.users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('addressee_id')->references('id')->on('hrmis.users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_doctracker')->dropIfExists('document_tracking_logs');
    }
}
