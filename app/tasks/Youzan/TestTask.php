<?php

namespace App\Tasks\Youzan;

use App\Common\Enums\RedisKey;
use App\Common\Youzan\Client;
use App\Tasks\Task;
use App\Utils\Redis;
use Xin\Cli\Color;

class TestTask extends Task
{

    public function mainAction()
    {
        echo Color::head('Help:') . PHP_EOL;
        echo Color::colorize('  有赞API测试') . PHP_EOL . PHP_EOL;

        echo Color::head('Usage:') . PHP_EOL;
        echo Color::colorize('  php run youzan:test@[action]', Color::FG_LIGHT_GREEN) . PHP_EOL . PHP_EOL;

        echo Color::head('Actions:') . PHP_EOL;
        echo Color::colorize('  token       获取授权Token', Color::FG_LIGHT_GREEN) . PHP_EOL;
        echo Color::colorize('  payQrcode  生成支付二维码', Color::FG_LIGHT_GREEN) . PHP_EOL;
    }

    public function tokenAction()
    {
        $token = Client::getInstance()->token();
        echo Color::colorize('TOKEN:' . $token) . PHP_EOL;
    }

    public function payQrcodeAction()
    {
        $res = Client::getInstance()->payQrcode();
        dd($res);
    }

}

