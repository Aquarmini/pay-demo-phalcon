<?php
// +----------------------------------------------------------------------
// | api.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

// 收款二维码
$router->add('/youzan/pay/qrcode', 'App\\Controllers\\Youzan\\Pay::qrcode');

// 统一支付
$router->add('/youzan/pay/pay', 'App\\Controllers\\Youzan\\Pay::pay');