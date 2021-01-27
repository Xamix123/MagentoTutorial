<?php

namespace Learning\BackendPlugins\Observer\Task4;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class FieldsNameObserver implements ObserverInterface
{
    public function execute(Observer $observer): FieldsNameObserver
    {
        $myEventData = $observer->getData('fieldsNames');

        echo '<tr bgcolor="#00008b">';
        foreach ($myEventData as $item) {
            echo '<td style="color: #FFFFFF">' . $item . '</td>';
        }
        echo '</tr>';

        return $this;
    }
}
