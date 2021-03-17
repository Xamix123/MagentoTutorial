<?php

namespace Learning\UiFormTest\Block\Adminhtml\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Learning\UiFormTest\Block\Adminhtml\Button\GenericButton;

class BackButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => 'setLocation(\'' . $this->getBackUrl() . '\')',
            'class' => 'back'
        ];
    }

    public function getBackUrl()
    {
        return $this->getUrl('admin/dashboard/');
    }
}
