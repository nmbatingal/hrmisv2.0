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
            $table->integer('user_id')->unsigned()->nullable();
            $table->enum('action', ['Received', 'Forwarded', 'Completed', 'Closed'])->nullable();
            $table->integer('route_to_office_id')->unsigned()->nullable();
            $table->integer('route_to_user_id')->unsigned()->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('code')->references('code')->on('doctracker.document_trackers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tracking_code')->references('tracking_code')->on('doctracker.document_trackers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('dost13.users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('route_to_office_id')->references('id')->on('dost13.offices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('route_to_user_id')->references('id')->on('dost13.users')->onDelete('cascade')->onUpdate('cascade');
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
