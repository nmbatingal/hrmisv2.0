<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->morphs('notifiable');
            // $table->integer('user_id')->unsigned()->nullable();
            // $table->integer('recipient_id')->unsigned()->nullable();
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('user_id')->references('id')->on('dost13.users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('recipient_id')->references('id')->on('dost13.users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('notifications');
    }
}
