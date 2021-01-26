<?php

namespace Learning\BackendPlugins\Observer\Task3;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class MultipleTriggerObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $counter = $observer->getData('counter');

        $color = $observer->getData('color');

        $textColor = $observer->getData('textColor');

        echo '<td bgcolor=' . $color . ' >' . $counter . '</td>';

        return $this;
    }
}
