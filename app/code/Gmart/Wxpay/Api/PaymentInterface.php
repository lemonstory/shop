<?php
namespace Gmart\Wxpay\Api;

interface PaymentInterface
{

    /**
     * return order pay info
     *
     * @api
     * @param string $openId    微信open id
     * @param int $productId    商品Id
     * @param string $orderNo   订单Id
     * @param string $body      商品简单描述
     * @param int $totalFee     订单金额
     * @param string $detail    商品详细描述
     * @return object
     */
    public function generatePayOrder($openId,$productId,$orderNo,$body,$totalFee,$detail='');
}