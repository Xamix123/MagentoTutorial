<?php

namespace Learning\AdminGrid\Block\Adminhtml\Email;

use Exception;
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
        try {
            return [
                'label' => __('Send Custom Email'),
                'class' => 'primary',
                'on_click' => "",
                'sort_order' => 100
            ];
        } catch (Exception $e) {
            echo($e->getMessage());
            die();
        }
    }

    public function getUrl(): string
    {
        return $this->urlBuilder->getUrl('admingrid/grid/send');
    }
}
