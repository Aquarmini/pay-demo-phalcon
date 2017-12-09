<?php

namespace App\Controllers\Youzan;

use App\Common\Support\OrderClient;
use App\Common\Youzan\Client;
use App\Controllers\Controller;

class PayController extends Controller
{
    /**
     * @desc   支付二维码
     * @author limx
     * @return bool|\Phalcon\Mvc\View
     */
    public function qrcodeAction()
    {
        $res = Client::getInstance()->payQrcode();
        $qrcode = $res['qr_code'];
        $this->view->qrcode = $qrcode;
        return $this->view->render('youzan/pay', 'qrcode');
    }

    /**
     * @desc   统一支付
     * @author limx
     */
    public function payAction()
    {
        $auth_token = $this->request->get('yz_auth_token');
        if (empty($auth_token)) {
            $url = 'https://h5.koudaitong.com/v2/common/YzAuth/get.html?redirect_url=' . env('YOUZAN_PAY_URL');
            return $this->response->redirect($url);
        }

        $order_id = OrderClient::getInstance()->id(rand(0, 1023), rand(0, 4095));
        $res = Client::getInstance()->pay($auth_token, $order_id);
        dd($res);
    }

}

