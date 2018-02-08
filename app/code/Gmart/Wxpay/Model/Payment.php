<?php

namespace Gmart\Wxpay\Model;

use Gmart\Wxpay\Api\UnifiedOrderInterface;
use Magento\Framework\DataObject;
use Magento\Payment\Model\InfoInterface;
use \Magento\Payment\Model\MethodInterface;
use \Magento\Payment\Model\Method\AbstractMethod;
use Carbon\Carbon;
use Magento\Framework\App\ObjectManager;
use Magento\Quote\Api\Data\CartInterface;
use Zend_Http_Client;


/**
 * Class Payment
 * @package Gmart\Wxpay\Model
 */
class Payment extends AbstractMethod
{

    const PAYMENT_METHOD_WXPAY_CODE = 'wxpay';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_WXPAY_CODE;
}