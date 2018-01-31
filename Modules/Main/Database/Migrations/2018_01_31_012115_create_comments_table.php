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
            $table->increments('comment_id')->comment("评论id");
            $table->integer("article_id")->comment("所属文章");
            $table->integer("type")->comment("评论类型");
            $table->integer("user_id")->comment("评论发表者");
            $table->integer("parent_id")->comment("评论接受者");
            $table->timestamps();
            $table->timestamp('delete_time')->comment("删除时间");
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
