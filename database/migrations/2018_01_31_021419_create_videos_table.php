<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id')->comment("视频id");
            $table->string('video_path',100)->comment("视频路径");
            $table->string("name",30)->comment('视频名称');
            $table->string('description',120)->nullable()->comment('视频描述');
            $table->integer('authority')->comment("用户权限");
            $table->integer("user_id")->comment("视频发表者");
            $table->integer("image_id")->comment('封面ｉｄ');
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
        Schema::dropIfExists('videos');
    }
}
