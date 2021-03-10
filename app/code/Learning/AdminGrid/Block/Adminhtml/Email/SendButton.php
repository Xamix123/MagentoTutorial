<?php

namespace Learning\AdminGrid\Block\Adminhtml\Email;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SendButton implements ButtonProviderInterface
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    public function getButtonData(): array
    {
        $message = "Are you sure you wanna send email to this address?";
        return [
            'label' => __('Send Custom Email'),
            'class' => 'primary',
            'on_click' => "confirmSetLocation('{$message}', '{$this->getCustomUrl()}')",
            'sort_order' => 100
        ];
    }

    public function getCustomUrl(): string
    {
        return $this->urlBuilder->getUrl('admingrid/grid/send');
    }
}
