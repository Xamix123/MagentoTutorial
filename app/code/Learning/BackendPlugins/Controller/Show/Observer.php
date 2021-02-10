<?php

namespace Learning\BackendPlugins\Controller\Show;

use Magento\Framework\App\Action\Action;
use Magento\Framework\DataObject;

class Observer extends Action
{
    public function execute()
    {
        $textDisplay = new DataObject(['text' => 'SomeText']);
        $this->_eventManager->dispatch('learning_backendplugins_show_text', ['mp_text' => $textDisplay]);
        echo $textDisplay->getText();
        $this->testFunctionEvent();
        $this->testMultipleTriggerObserver();
        exit;
    }

    public function testFunctionEvent()
    {
        $this->_eventManager->dispatch('learning_backendplugins_show_testevent');
        echo 'i am in original function<br>';
    }

    public function testMultipleTriggerObserver()
    {
        $color = ['#000000', '#FFFFFF'];

        echo '<br>________________________________________________<br>';
        echo '<table>';
        echo '<tr>';
        for ($i = 1; $i <= 64; $i++) {
            $this->_eventManager->dispatch(
                'learning_backendplugins_show_multipleTrigger',
                [
                        'counter' => $i,
                        'color' => $i % 2 == 0 ? $color[0] : $color[1],
                        'textColor' => $i % 2 == 0 ? $color[1] : $color[0]
                    ]
            );
            if ($i % 8 == 0) {
                echo '</tr><tr>';
                $tmp = $color[0];
                $color[0] = $color[1];
                $color[1] = $tmp;
            }
        }
        echo '</tr>';
        echo '</table>';
        echo '<br>________________________________________________<br>';
    }
}
