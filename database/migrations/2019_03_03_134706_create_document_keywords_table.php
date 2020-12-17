<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('document_keywords', function (Blueprint $table) {
            // $table->increments('id');
            $table->integer('document_id')->unsigned();
            $table->char('keywords', 20);
            // $table->timestamps();

            $table->unique(['document_id', 'keywords']);

            $table->foreign('document_id')->references('id')->on('doctracker.document_trackers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('document_keywords');
    }
}
