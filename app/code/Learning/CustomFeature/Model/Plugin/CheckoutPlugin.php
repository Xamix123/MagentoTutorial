<?php

namespace Learning\CustomFeature\Model\Plugin;

use Magento\Checkout\Model\PaymentInformationManagement;

class CheckoutPlugin
{
    public function beforeGetPaymentInformation(PaymentInformationManagement $subject)
    {
        var_export("i am here");die();
    }
}
