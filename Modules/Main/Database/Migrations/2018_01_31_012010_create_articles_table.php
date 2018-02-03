<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('article_id')->comment("文章id");
            $table->integer('user_id')->comment('用户id');
            $table->integer('type_id')->comment("类型的id");//关联外键
            $table->string('article_title',20)->comment('文章标题');
            $table->integer('authority')->comment("用户权限");
            $table->integer('praise')->default(0)->comment("获得赞");
            $table->integer('shame')->default(0)->comment("获得踩");
            $table->integer('readnum')->default(0)->comment("浏览量");
            $table->integer('status')->comment("文章状态");
            $table->integer('notebook_id')->comment("所属笔记");//关联外键
            $table->string('cover_path',100)->comment("封面路径");
            $table->softDeletes()->comment("软删除");
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
        Schema::dropIfExists('articles');
    }
}
