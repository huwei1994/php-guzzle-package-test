<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('log_title', 100)->notnull()->comment('公告标题');
            $table->softDeletes();//软删除
            $table->timestamps();//自动维护时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
