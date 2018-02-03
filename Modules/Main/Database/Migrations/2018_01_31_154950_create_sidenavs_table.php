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
            $table->string('title','10')->comment('侧边栏的名字');
            $table->string('icon','50')->comment('侧边栏的图标');
            $table->string('href','50')->comment('侧边栏搞的地址');
            $table->integer('children_id')->default(0)->comment('孩子的id');
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
