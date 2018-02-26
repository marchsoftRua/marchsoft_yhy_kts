<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->comment("评论id");
            $table->integer("belong_id")->comment("所属于的表 如文章、视频");
            $table->string("type")->comment("评论类型 评论的是什么 存表名");
            $table->text("comment_inner")->comment("评论内容");
            $table->integer("user_id")->comment("评论发表者");
            $table->integer("parent_id")->comment("评论接受者");
            $table->integer("praise")->default(0)->comment("赞美の心");
            $table->timestamps();
            $table->softDeletes()->comment("软删除");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
