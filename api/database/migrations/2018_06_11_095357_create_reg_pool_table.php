<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegPoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_pool', function (Blueprint $table) {
            $table->increments('reg_pool_id');
            $table->string('reg_pool_uuid');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->string('nickname');
            $table->string('gender')->nullable();
            $table->string('email');
            $table->string('mobile_no');
            $table->string('affiliation', 100);
            $table->string('role')->nullable();
            $table->string('token', 100)->nullable();
            $table->integer('ticket_id');
            $table->string('activity', 255);
            $table->integer('event_id');
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
        Schema::dropIfExists('reg_pool');
    }
}
