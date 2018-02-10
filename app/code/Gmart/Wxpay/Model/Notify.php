<?php

namespace Gmart\Wxpay\Model;
use Gmart\Wxpay\Api\NotifyInterface;


/**
 * Class Payment
 *
 * @api
 * @since 100.0.2
 */
class Notify implements NotifyInterface
{

    /**
     * 支付结果通知(接收微信支付异步通知回调地址,通知url必须为直接可访问的url)
     * @see https://pay.weixin.qq.com/wiki/doc/api/app/app.php?chapter=9_7&index=3
     *
     * @api
     * @return $this
     */
    public function notify()
    {
//        $body = Yii::$app->request->getRawBody();
        $xml = <<<EOF
<xml>
  <appid><![CDATA[wx2421b1c4370ec43b]]></appid>
  <attach><![CDATA[支付测试]]></attach>
  <bank_type><![CDATA[CFT]]></bank_type>
  <fee_type><![CDATA[CNY]]></fee_type>
  <is_subscribe><![CDATA[Y]]></is_subscribe>
  <mch_id><![CDATA[10000100]]></mch_id>
  <nonce_str><![CDATA[5d2b6c2a8db53831f7eda20af46e531c]]></nonce_str>
  <openid><![CDATA[oUpF8uMEb4qRXf22hE3X68TekukE]]></openid>
  <out_trade_no><![CDATA[1409811653]]></out_trade_no>
  <result_code><![CDATA[SUCCESS]]></result_code>
  <return_code><![CDATA[SUCCESS]]></return_code>
  <sign><![CDATA[B552ED6B279343CB493C5DD0D78AB241]]></sign>
  <sub_mch_id><![CDATA[10000100]]></sub_mch_id>
  <time_end><![CDATA[20140903131540]]></time_end>
  <total_fee>1</total_fee>
  <trade_type><![CDATA[JSAPI]]></trade_type>
  <transaction_id><![CDATA[1004400740201409030005092168]]></transaction_id>
</xml>
EOF;
        $postObj = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
        $postParams['appid'] = (string)$postObj->appid;
        $postParams['attach'] = (string)$postObj->attach;
        $postParams['bank_type'] = (string)$postObj->bank_type;
        $postParams['fee_type'] = (string)$postObj->fee_type;
        $postParams['is_subscribe'] = (string)$postObj->is_subscribe;
        $postParams['mch_id'] = (string)$postObj->mch_id;
        $postParams['nonce_str'] = (string)$postObj->nonce_str;
        $postParams['openid'] = (string)$postObj->openid;
        $postParams['out_trade_no'] = (string)$postObj->out_trade_no;
        $postParams['result_code'] = (string)$postObj->result_code;
        $postParams['sub_mch_id'] = (string)$postObj->sub_mch_id;
        $postParams['time_end'] = (string)$postObj->time_end;
        $postParams['total_fee'] = (string)$postObj->total_fee;
        $postParams['trade_type'] = (string)$postObj->trade_type;
        $postParams['transaction_id'] = (string)$postObj->transaction_id;
        $postParams['return_code'] = (string)$postObj->return_code;
//        var_dump($postParams);
        $generatePostSign = $this->generateSign($postParams);
        $postSign = (string)$postObj->sign;
        //获取uid
        $uid = 0;
        $attachQueryStr = urldecode($postParams['attach']);
        if (!empty($attachQueryStr)) {
            parse_str($attachQueryStr, $attach);
            $uid = $attach['uid'];
        }
        //签名验证
        //TODO:校验返回的订单金额是否与商户侧的订单金额一致
        if (0 == strcmp($generatePostSign, $postSign)) {
            $resParams['return_code'] = "SUCCESS";
            $resParams['return_msg'] = "OK";
        } else {
            $resParams['return_code'] = "FAIL";
            //签名失败
            //参数格式校验错误
            $resParams['return_msg'] = "签名失败";
        }
        $resXml = $this->paramsToXml($resParams);
        echo $resXml;
    }
}