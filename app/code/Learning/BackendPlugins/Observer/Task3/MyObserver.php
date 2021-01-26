<?php

namespace Learning\BackendPlugins\Observer\Task3;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class MyObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $myEventData = $observer->getData('mp_text');
        echo $myEventData->getText() . " - Event MyObserver </br>";
        $myEventData->setText('Hello Johnny i am new Text of function');

        return $this;
    }
}
