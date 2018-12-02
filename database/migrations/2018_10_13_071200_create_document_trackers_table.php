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
            $table->char('code', 10)->nullable()->unique();
            $table->string('tracking_code')->nullable()->unique();
            // $table->integer('creator_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            // $table->json('recipients')->nullable();
            // $table->integer('route_to_office_id')->unsigned()->nullable();
            // $table->integer('route_to_user_id')->unsigned()->nullable();
            $table->enum('route_mode', ['All', 'Group', 'Individual'])->nullable();
            $table->integer('doc_type_id')->unsigned()->nullable();
            $table->string('other_document')->nullable();
            $table->date('document_date')->nullable();
            $table->string('subject')->nullable();
            $table->text('details')->nullable();
            $table->string('keywords')->nullable();
            $table->boolean('isRouteComplete')->default(false);
            $table->boolean('isDocCancelled')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('dost13.users')->onDelete('cascade');
            // $table->foreign('recipient_id')->references('id')->on('dost13.users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('route_to_office_id')->references('id')->on('dost13.offices')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('route_to_user_id')->references('id')->on('dost13.users')->onDelete('cascade')->onUpdate('cascade');
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
