<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('image_id')->comment("图片id");
            $table->integer("user_id")->comment("图片发表者");
            $table->string('image_path',100)->comment("图片路径");
            $table->timestamps();
            $table->integer('authority')->comment("用户权限");
            $table->dateTime('delete_time')->comment("删除时间");
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
        Schema::dropIfExists('images');
    }
}
