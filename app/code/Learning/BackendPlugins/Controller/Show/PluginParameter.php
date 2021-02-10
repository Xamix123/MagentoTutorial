<?php

namespace Learning\BackendPlugins\Controller\Show;

use Magento\Framework\App\Action\Action;

class PluginParameter extends Action
{
    public function execute()
    {
        $name =  $this->targetForParameterPlugin("test");

        echo $name;
    }

    public function targetForParameterPlugin($name)
    {
        echo "i am target for plugin (+) - $name<br>";

        $name = 'i am result string';

        return $name;
    }
}
