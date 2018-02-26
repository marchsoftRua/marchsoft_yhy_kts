<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSidenavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidenavs', function (Blueprint $table) {
            $table->increments('id')->comment('侧边栏主键');
            $table->integer('menu_id')->comment('菜单的id');
            $table->string('title','10')->comment('菜单下的侧边栏的名字');
            $table->string('icon','50')->comment('侧边栏的图标');
            $table->string('href','50')->comment('侧边栏搞的地址');
            $table->integer('father_id')->default(0)->comment('父亲的id');
            $table->boolean('spread')->default(0)->comment('子菜单是否展开。（默认不展开）');
            $table->string('target','10')->nullable()->comment('控制对应页面链接的打开方式。不设置的情况下以窗口形式打开，设置后页面整体跳转，如“登录页面”。可选参数：_blank。');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sidenavs');
    }
}
