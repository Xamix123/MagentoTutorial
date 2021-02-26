<?php

namespace Learning\CustomLogger\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class CustomLoggerObserver implements ObserverInterface
{
    private $authSession;

    private $logger;

    public function __construct(
        Session $authSession,
        LoggerInterface $logger
    ) {
        $this->authSession = $authSession;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        /** @var ProductInterface $product */
        $product = $observer->getEvent()->getData('product');

        $authUser = $this->authSession->getUser();
        if ($authUser != null) {
            $userId = $authUser->getId();
            $userName = $authUser->getName();

            $authUser = ($userId !== null && $userName !== null)
                ? 'User Id: ' . $userId . ' User Name: ' . $userName
                : 'Undefined user';
        } else {
            $authUser = 'Undefined user';
        }

        $message = $product->getCreatedAt() === $product->getUpdatedAt()
           ? ' Item was created.'
           : ' Item was updated.';

        $this->logger->debug($message .
            ' Item ID: ' . $product->getId() .
            ' Item Name: ' . $product->getName() .
            ' by ' . $authUser);
    }
}
