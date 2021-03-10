<?php

namespace Learning\AdminGrid\Block\Adminhtml\Email;
use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class SendButton extends Generic
{
    public function getButtonData()
    {
        return [
            'label' => __('Send Custom Email'),
            'class' => 'primary',
            'on_click' => "alert('it works')",
            'sort_order' => 100
        ];
    }

}
