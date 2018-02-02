define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'wxpay',
                component: 'Gmart_Wxpay/js/view/payment/method-renderer/wxpay'
            }
        );
        return Component.extend({});
    }
);