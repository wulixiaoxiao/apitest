<?php

namespace App\Http\Controllers;

use App\Order;
use Ixudra\Curl\Facades\Curl;
use GuzzleHttp\Handler\CurlFactory;
use Illuminate\Routing\Controller as BaseController;

class RenqiController extends BaseController
{
    function login() {
        $res = Curl::to("")
            ->withHeaders([
                "X-Requested-With:XMLHttpRequest"
            ])
            ->withData([
                'cardno' => '',
                'password' => '',
                'username' => '',
                'username_password' => '',
                'sendpass_username' => '',
                'reg_username' => '',
                'reg_password' => '',
                'reg_sex' => 0,
                'reg_qq' => '',
                'code' => '',
                'id' => 15,
                'goods_type' => 6,
            ])
            ->setCookieJar(BASE_PATH.'/cookie/cookie.txt')
            ->post();
        \Log::debug('renqiLogin', ['info' => serialize($res)]);
    }

    public function send() {
        $res = Curl::to("")
            ->withHeaders([
                "X-Requested-With:XMLHttpRequest"
            ])
            ->withData([
                'qq' => '903933450',
                'need_num_0' => 500,
                'goods_id' => 15,
                'goods_type' => 6,
                'pay_type' => 0,
            ])
            ->setCookieFile(BASE_PATH.'/cookie/cookie.txt')
            ->post();
        $res = \GuzzleHttp\json_decode($res);
        \Log::debug('renqiOrder', ['info' => serialize($res)]);

        if ($res->status == 0) {
            if (strstr($res->info, '未登录')) {
                $this->login();
                $this->send();
            }elseif (strstr($res->info, '权限设置不正确')) {
                echo '权限设置不正确';
            }elseif (strstr($res->info, '下单失败')) {
                echo '下单失败';
            }
        }else{
            Order::create([
                'orderSn' => date('Ymd').substr(time(), 5).rand(10000,99999),
                ''
            ]);
        }
        echo '<pre>';
        print_r($res);
    }
}
