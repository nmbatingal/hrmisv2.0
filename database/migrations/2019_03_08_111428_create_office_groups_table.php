<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_name')->nullable();
            $table->string('acronym')->nullable();
            // $table->timestamps();

            $table->unique(['group_name', 'acronym']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_groups');
    }
}
