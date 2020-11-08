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
            $table->text('purpose');
            $table->date('meetingdate',0);
            $table->time('meetingtime',0);
            $table->string('duration',11);
            $table->string('meetingtype',11);
            $table->text('remarks');
            $table->text('comments');
            $table->integer('total');
            $table->date('postingdate');
            $table->date('approvedate');
            $table->string('approveuser');
            $table->integer('postuser_id');
            $table->integer('room_id');
            $table->integer('category_id');
            $table->foreign('postuser_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('coffee',3);
            $table->string('snacks',3);
            $table->string('status',12);
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
