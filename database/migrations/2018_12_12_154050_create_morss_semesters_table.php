<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMorssSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql4')->create('morss_semesters', function (Blueprint $table) {
            $table->increments('id');
            $table->date('month_from');
            $table->date('month_to');
            $table->boolean('status')->default(false);
            $table->longText('questions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql4')->dropIfExists('morss_semesters');
    }
}
