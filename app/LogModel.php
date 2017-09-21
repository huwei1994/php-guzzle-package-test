<?php
/**
 * Created by PhpStorm.
 * User: huwei
 * Date: 2017/9/20
 * Time: 11:50
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogModel extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'log';

    /**
     * @var array
     */
    protected $fillable = ['id', 'log_title','deleted_at','created_at','updated_at'];

}