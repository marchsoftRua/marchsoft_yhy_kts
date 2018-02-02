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
            $table->increments('user_id')->comment('用户id');
            $table->string('user_name',12)->comment('用户名');
            $table->string('user_password',12)->comment('用户密码');
            $table->string('user_playname',12)->comment('用户昵称');
            $table->integer('group_id')->comment('分组id');
            $table->string('user_email',30)->comment('用户邮箱');
            $table->rememberToken()->comment('记住用户');
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
