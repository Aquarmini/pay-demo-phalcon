<?php

namespace App\Controllers\Youzan;

use App\Common\Youzan\Client;
use App\Controllers\Controller;

class PayController extends Controller
{

    public function qrcodeAction()
    {
        $res = Client::getInstance()->payQrcode();
        $qrcode = $res['qr_code'];
        $this->view->qrcode = $qrcode;
        return $this->view->render('youzan/pay', 'qrcode');
    }

}

