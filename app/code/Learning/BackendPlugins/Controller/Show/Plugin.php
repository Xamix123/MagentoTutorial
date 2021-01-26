<?php

namespace Learning\BackendPlugins\Controller\Show;

use Magento\Framework\App\Action\Action;

class Plugin extends Action
{
    public function execute()
    {
        $this->targetForPlugin("test");
    }

    public function targetForPlugin($name)
    {
        echo "i am target for plugin (+) - $name<br>";
    }
}
