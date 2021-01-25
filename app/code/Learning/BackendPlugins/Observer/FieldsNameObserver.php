<?php

namespace Learning\BackendPlugins\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class FieldsNameObserver implements ObserverInterface
{
    public function execute(Observer $observer): FieldsNameObserver
    {
        $myEventData = $observer->getData('fieldsNames');

        echo '<tr bgcolor="#00008b">';
        foreach ($myEventData as $item) {
            echo '<td>' . $item . '</td>';
        }
        echo '</tr>';

        return $this;
    }
}
