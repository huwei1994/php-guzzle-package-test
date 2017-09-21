<?php

/**
 * Created by PhpStorm.
 * User: huwei
 * Date: 2017/9/20
 * Time: 11:44
 */
namespace App\Observer;
use App\AppNoticeModel;
use Illuminate\Support\Facades\Log;
use App\LogModel;

class AppNoticeObserver
{
    /**
     * 监听用户创建的事件。
     *
     * @param  User  $user
     * @return void
     */
    public function created(AppNoticeModel $notice)
    {
        //
        //Log::info('差你妈，进来了');
        $insert = array(
            'log_title' => '胡伟进来了',
        );
        LogModel::create($insert);
    }

}