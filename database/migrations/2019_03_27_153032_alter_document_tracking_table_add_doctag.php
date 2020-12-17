<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDocumentTrackingTableAddDoctag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->table('document_trackers', function (Blueprint $table) {
            $table->integer('tagged_doc_id')->unsigned()->nullable()->after('tracking_code');

            $table->foreign('tagged_doc_id')->references('id')->on('doctracker.document_trackers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->table('document_trackers', function (Blueprint $table) {
            $table->dropForeign(['tagged_doc_id']);
            $table->dropColumn(['tagged_doc_id']);
        });
    }
}
