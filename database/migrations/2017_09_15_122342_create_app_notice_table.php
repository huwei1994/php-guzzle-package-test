<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('app_notice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('notice_title', 100)->notnull()->comment('公告标题');
            $table->text('notice_desc')->notnull()->comment('公告富文本框内容');
            $table->double('notice_longitude', 12, 8)->nullable()->comment('接收公告范围经度');
            $table->double('notice_latitude', 12, 8)->nullable()->comment('接收公告范围纬度');
            $table->timestamp('begin_time')->nullable()->comment('公告有效期开始时间');
            $table->timestamp('end_time')->nullable()->comment('公告有效期结束时间');
            $table->unsignedTinyInteger('status')->notnull()->default(1)->comment('公告状态，0：禁用，1：启用');
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
