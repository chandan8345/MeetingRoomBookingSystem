<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50);
            $table->text('purpose');
            $table->dateTime('dateTime',0)->unique();;
            $table->string('duration',11);
            $table->date('postingdate');
            $table->date('approvedate');
            $table->string('approveuser');
            $table->integer('postuser_id');
            $table->integer('room_id');
            $table->integer('category_id');
            $table->foreign('postuser_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->boolean('coffee');
            $table->boolean('snacks');
            $table->integer('status');
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
        Schema::dropIfExists('posts');
    }
}
