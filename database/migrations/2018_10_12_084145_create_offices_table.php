<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('division_name')->nullable();
            $table->char('div_acronym', 20)->nullable();
            $table->integer('div_head_id')->unsigned()->nullable();
            $table->integer('div_under_id')->unsigned()->nullable();
            // $table->integer('receiver_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('div_under_id')->references('id')->on('offices')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('users', function($table) {
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropForeign(['office_id']);
            $table->dropColumn('office_id');
        });

        Schema::dropIfExists('offices');
    }
}
