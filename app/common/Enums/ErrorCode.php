<?php
// +----------------------------------------------------------------------
// | ErrorCode.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Enums;

use Xin\Phalcon\Enum\Enum;

class ErrorCode extends Enum
{
    /**
     * @Message('系统错误')
     */
    public static $ENUM_SYSTEM_ERROR = 400;

    /**
     * @Message('获取有赞Token失败')
     */
    public static $ENUM_YOUZAN_CREATE_TOKEN_FAILED = 1000;

    /**
     * @Message('生成有赞收款二维码失败')
     */
    public static $ENUM_YOUZAN_CREATE_PAY_QRCODE_FAILED = 1001;
}