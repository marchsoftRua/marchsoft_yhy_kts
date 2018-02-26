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
            $table->increments('id')->comment('用户id');
            $table->string('name',10)->default('康宏顺')->comment('用户的真实姓名');
            $table->boolean('sex')->default(0)->comment('用户的性别 1男 0女 ');
            $table->string('province',10)->nullable()->comment('省');
            $table->string('city',10)->nullable()->comment('市');
            $table->string('area',10)->nullable()->comment('区');
            $table->string('myself',120)->nullable()->comment('用户自我介绍');
            $table->dateTime('birthday')->nullable()->comment('用户的生日');
            $table->string('head_url')->default("/public/defualt_img.jpg")->comment("用户头像的url地址");
            $table->string('password',255)->comment('用户密码');
            $table->string('user_playname',12)->comment('用户昵称');
            $table->integer('group_id')->default(0)->comment('分组id');
            $table->integer('user_type')->default(0)->comment("用户类型 管理员等");
            $table->string('email',30)->comment('用户邮箱');
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
