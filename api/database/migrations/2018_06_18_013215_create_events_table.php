<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id');
            $table->string('name');
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location');
            $table->string('poster_path');
            $table->string('tags');
            $table->string('fb_url');
            $table->string('tw_url');
            $table->string('ig_url');
            $table->string('web_url');
            $table->string('status');
            $table->tinyInteger('isDraft');
            $table->tinyInteger('isPublish');
            $table->tinyInteger('isDown');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('events');
    }
}
