<?php

namespace Learning\Email\Block\Adminhtml\Send;

use Learning\Email\Block\Adminhtml\Send\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SendButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData(): array
    {
        return [
            'label' => __('Send'),
            'class' => 'primary',
            'on_click' => 'deleteConfirm(\''
                . __('Are you sure you wanna send a letter? ?')
                . '\', \'' . $this->getSendUrl() . '\')',
        ];
    }

    public function getSendUrl(): string
    {
        return $this->getUrl('*/*/main');
    }
}
