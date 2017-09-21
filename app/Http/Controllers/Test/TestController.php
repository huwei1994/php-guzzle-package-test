<?php

/**
 * Created by PhpStorm.
 * User: huwei
 * Date: 2017/9/9
 * Time: 10:37
 */
namespace App\Http\Controllers\Test;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use AppRefresh\AppRefresh;
use App\AppNoticeModel;


class TestController extends Controller
{
    use AppRefresh;

    public function kk()
    {
        $insert_data = array(
            'notice_title' => '哈哈',
            'notice_desc' => '哈哈',
            'notice_longitude' => '112.266101',//经度
            'notice_latitude' => '30.328655',//纬度
            'begin_time' => date("Y-m-d H:i:s",1483200000),//起始时间，默认2017-1-1
            'end_time' => date("Y-m-d H:i:s",2145888000),//结束时间，默认2038-1-1
            'status' => 1,//公告状态，0禁用，1启用
        );
        
        AppNoticeModel::create($insert_data);
    }

    public function mm()
    {
        dump($this->getFileds('refresh_user_id'));
    }

    public function hh()
    {
        //同步请求
        $client = new Client();
        $response = $client->request('GET', 'http://www.baidu.com', [
            "timeout" => 3000
        ]);

        echo $response->getStatusCode(), "\n";
        echo $response->getBody();
    }

    public function jj()
    {
        //异步请求
        $client = new Client();
        $promise = $client->requestAsync('GET', 'http://www.baidu.com');
        $promise->then(
            function (ResponseInterface $res) {
                echo $res->getStatusCode() . "\n";
                echo $res->getBody();
                return $res;
            },
            function (RequestException $e) {
                echo $e->getMessage() . "\n";
                echo $e->getRequest()->getMethod();
            }
        )->wait();
    }

    //使用GUZZLE测试访问，卡车兄弟的接口
    public function nn()
    {
        $appid = 'ggggggggggg';
        $appsecret = 'ggggggggggggggggggg';
        $timestamp = time();
        $nonce = (int)substr(microtime(true), 0, 6);
        $signature = md5($appid.$timestamp.$nonce.$appsecret);
        $client = new Client(['base_uri' => 'http://www.whutimaker.club:8080']);

        $response = $client->request('GET','/CouponSystemFinal/EXI/getMemCoupons/15071455817', [
            'headers' => [
                'Content-Type'=> 'application/json',//以json格式传输
                'appid' => $appid,
                'timestamp' => $timestamp,
                'nonce' => $nonce,
                'signature' => $signature,
            ]]);
        //dump($response);
        //这里注意。返回值是stdObj格式的。先转换在使用
        $res = json_decode($response->getBody(),true);

        if(isset($res) && isset($res['resultCode']) && $res['resultCode'] == 1
            && isset($res['coupons']))
        {
            $data  = [];
            //这里我可以把数据处理一下。
            foreach($res['coupons'] as $result)
            {
                if(isset($result['couponGroup']))
                {
                    $hh = [];
                    $limit_value = isset($result['couponGroup']['limitValue'])?$result['couponGroup']['limitValue']:0;
                    $type = 2;//满减
                    if(!$limit_value)
                    {
                        $type = 1;//无限制
                    }
                    $str_start_time = isset($result['startDate'])?$result['startDate']:'';
                    if($str_start_time)
                    {
                        $str_start_time = date('Y-m-d',strtotime($str_start_time));
                    }
                    $str_end_time = isset($result['endDate'])?$result['endDate']:'';
                    if($str_end_time)
                    {
                        $str_end_time = date('Y-m-d',strtotime($str_end_time));
                    }

                    $hh['id'] = isset($result['id'])?$result['id']:'';
                    $hh['groupId'] = isset($result['couponGroup']['groupId'])?$result['couponGroup']['groupId']:'';
                    $hh['groupName'] = isset($result['couponGroup']['groupName'])?$result['couponGroup']['groupName']:'';
                    $hh['value'] = isset($result['couponGroup']['value'])?$result['couponGroup']['value']:'';
                    $hh['limitValue'] = isset($result['couponGroup']['limitValue'])?$result['couponGroup']['limitValue']:'';
                    $hh['startDate'] = $str_start_time;
                    $hh['endDate'] = $str_end_time;
                    $hh['type'] = $type;
                    $data[] = $hh;
                }
                else
                {
                    continue;
                }
            }
            dump($data);
        }
        else
        {
            dump(21323);
        }
    }

    //GET方式，请求头测试
    public function qq()
    {
        $appid = 'gdsgsgdfsgsgsdgf';
        $appsecret = 'dfdgsgsdgsdfgdfsgg';
        $timestamp = time();
        $nonce = (int)substr(microtime(true), 0, 6);
        $signature = md5($appid.$timestamp.$nonce.$appsecret);
        $client = new Client(['base_uri' => 'http://192.168.1.142:8082']);

        $response = $client->request('GET','/test/aa', [
            'headers' => [
                'Content-Type'=> 'application/json',//以json格式传输
                'appid' => $appid,
                'timestamp' => $timestamp,
                'nonce' => $nonce,
                'signature' => $signature,
            ]]);
        echo($response->getBody());

    }

    //post方式请求生意专家接口，和header测试。上传json数据，
    //上传参数不用json_encode了。这个包会将其转为json格式
    public function po()
    {
        $appid = 'gggggggg';
        $appsecret = 'gggggggggggggg';
        $timestamp = time();
        $nonce = (int)substr(microtime(true), 0, 6);
        $signature = md5($appid.$timestamp.$nonce.$appsecret);
        //$client = new Client(['base_uri' => 'http://192.168.1.142:8082']);
        $client = new Client(['base_uri' => 'http://open.i200.cn']);



        $options['account_id'] = 111;
        $options['group_id'] = 111;
        $options['cellphone'] = 18202769655;
        $options['name'] = '胡伟';
        $options['sex'] = 1;
        $options['birth'] = 1505959727;
        $options['photo'] = '';
        $options['truck_num'] = '鄂A12345';
        $options['owner'] = 1;
        $options['driving_license_num'] = '500235199407107548';

        //转化之前，获取这两个值
        $goods_type_id = 1;
        $truck_container_type_id = 1;

        $options['truck_brand_id'] = 1;
        $options['goods_type_id'] = 1;//传递配置文件中的对应值
        $options['truck_type_id'] = 1;
        //传递配置文件中的对应值
        $options['truck_container_type_id'] = 1;
        $options['using_property'] = 1;
        $options['truck_identify_code'] = 1;
        $options['engine_num'] = '';
        $options['register_time'] = '';
        $options['certificate_time'] = '';
        $options['address'] = '';

        //$par = json_encode($options);

        //获取生意专家，所有店铺优惠券参数
        $hh[0]['account_id'] = 3393099;
        $hh[1]['begin_date'] = 946656000;
        //dump($par);
        //$response = $client->request('POST','/test/bb', [
        //$response = $client->request('POST','/v0/bc/active-coupon', [
        $response = $client->request('POST','/v0/bc/accountCoupons', [
            'headers' => [
                'Content-Type'=> 'application/json',//以json格式传输
                'appid' => $appid,
                'timestamp' => $timestamp,
                'nonce' => $nonce,
                'signature' => $signature,
            ],
            'json' => $hh
        ]);
        echo($response->getBody());
    }
}