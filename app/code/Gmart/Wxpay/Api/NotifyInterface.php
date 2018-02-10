<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/2/7
 * Time: 下午10:56
 */

namespace Gmart\Wxpay\Api;
interface NotifyInterface
{

    /**
     * 异步接收微信支付结果通知的回调地址，通知url必须为外网可访问的url，不能携带参数
     *
     * @api
     * @return $this
     */
    public function notify();
}