<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTLeaveUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_leave_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staffid',191);
            $table->string('name',191);
            $table->string('role',191)->nullable();
            $table->string('email',191)->nullable();
            $table->string('password',191);
            $table->string('mobile',11)->nullable();
            $table->string('gender',191)->nullable();
            $table->integer('designation_id')->nullable();
            $table->integer('line_man_id')->nullable();
            $table->integer('band_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->datetime('join_date',0)->nullable();
            $table->integer('onProbation')->nullable();
            $table->integer('active')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('picture',199)->nullable();
            $table->string('remember_token',100)->nullable();
            $table->integer('is_mancom')->default(0);
            $table->integer('status_updated_by')->nullable();
            $table->datetime('status_updated_at')->nullable();
            $table->string('ims_id',191)->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('car_booking_role_id')->default(4);
            $table->string('room_booking_role')->default('user');
            //$table->string('room_booking_role')->default('admin');
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
        Schema::dropIfExists('t_leave_users');
    }
}
