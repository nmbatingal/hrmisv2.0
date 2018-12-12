<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //$table->uuid('id')->primary();
            $table->increments('id');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');

            $table->string('sex')->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();

            $table->string('email')->unique();
            $table->char('mobile', 15)->nullable();
            $table->integer('office_id')->unsigned()->nullable();
            $table->char('position', 20)->nullable();
            $table->boolean('isActive')->default(false);
            $table->boolean('isAdmin')->default(false);
            
            $table->string('username', 25)->unique();
            $table->string('password');
            $table->string('user_image')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
