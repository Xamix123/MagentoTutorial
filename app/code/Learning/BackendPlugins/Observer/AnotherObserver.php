<?php

namespace Learning\BackendPlugins\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AnotherObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $myEventData = $observer->getData('mp_text');

        if (isset($myEventData)) {
            echo $myEventData->getText() . " - Event AnotherObserver </br>";
        } else {
            echo " it`s another function from - Event Another Observer yay <br>";
        }

        return $this;
    }
}
