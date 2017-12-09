<?php
// +----------------------------------------------------------------------
// | Client.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Youzan;

use App\Common\Enums\ErrorCode;
use App\Common\Enums\RedisKey;
use App\Common\Exceptions\CodeException;
use App\Utils\Redis;
use Xin\Traits\Common\InstanceTrait;
use Youzan\Open\Client as YzClient;

class Client
{
    use InstanceTrait;

    public function token()
    {
        $clientId = env('YOUZAN_CLIENT_ID');
        $clientSecret = env('YOUZAN_CLIENT_SECRET');

        $redis_key = sprintf(RedisKey::YOUZAN_ACCESS_TOKEN, md5($clientId . $clientSecret));

        if ($token = Redis::get($redis_key)) {
            return $token;
        }

        $type = 'self';
        $keys['kdt_id'] = env('YOUZAN_KDT_ID');

        $accessToken = (new \Youzan\Open\Token($clientId, $clientSecret))->getToken($type, $keys);
        if (empty($accessToken['access_token']) || empty($accessToken['expires_in'])) {
            throw new CodeException(ErrorCode::$ENUM_YOUZAN_CREATE_TOKEN_FAILED);
        }

        $token = $accessToken['access_token'];
        $expires_in = $accessToken['expires_in'];
        $expires_in = $expires_in > 4800 ? $expires_in - 4800 : $expires_in;

        Redis::set($redis_key, $token);
        Redis::expire($redis_key, $expires_in - 4800);

        return $token;
    }

    public function payQrcode()
    {
        $token = $this->token();//请填入商家授权后获取的access_token
        $client = new YzClient($token);

        $method = 'youzan.pay.qrcode.create'; //要调用的api名称
        $api_version = '3.0.0'; //要调用的api版本号

        $my_params = [
            'qr_name' => '測試',
            'qr_price' => '1',
            'qr_type' => 'QR_TYPE_NOLIMIT',
        ];

        $my_files = [
        ];

        $result = $client->post($method, $api_version, $my_params, $my_files);
        if (!isset($result['response'])) {
            throw new CodeException(ErrorCode::$ENUM_YOUZAN_CREATE_PAY_QRCODE_FAILED);
        }

        return $result['response'];
    }

}