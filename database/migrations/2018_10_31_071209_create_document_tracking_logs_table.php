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
        Schema::connection('mysql2')->create('document_tracking_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 20)->index()->nullable();
            $table->string('tracking_code')->index()->nullable();
            $table->enum('action', ['Forward', 'Receive', 'Close', 'Cancel'])->nullable();
            $table->integer('sender_id')->unsigned()->nullable();
            $table->integer('office_id')->unsigned()->nullable();
            $table->integer('recipient_id')->unsigned()->nullable();
            $table->boolean('recipient_received')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('code')->references('code')->on('doctracker.document_trackers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tracking_code')->references('tracking_code')->on('doctracker.document_trackers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sender_id')->references('id')->on('hrmis.users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('office_id')->references('id')->on('hrmis.offices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('recipient_id')->references('id')->on('hrmis.users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('document_tracking_logs');
    }
}
