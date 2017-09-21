<?php
/**
 * Created by PhpStorm.
 * User: huwei
 * Date: 2017/9/15
 * Time: 12:44
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class AppNoticeModel extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'app_notice';

    /**
     * @var array
     */
    protected $fillable = ['id', 'notice_title', 'notice_desc', 'notice_longitude'
        ,'notice_latitude','begin_time','end_time','status'];

}