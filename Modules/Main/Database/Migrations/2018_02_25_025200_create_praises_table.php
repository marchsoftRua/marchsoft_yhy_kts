<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePraisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('praises', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('praise_from')->comment('点赞者');
            $table->integer('praise_to')->comment('被点赞对象');
            $table->integer('obj_type')->comment('被点赞对象类型');
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
        Schema::dropIfExists('praises');
    }
}
