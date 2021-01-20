<?php

namespace Learning\BackendPlugins\Controller\Show;

use Magento\Framework\App\Action\Action;

class Page extends Action
{
    public function execute()
    {
        $this->targetForPlugin();
    }

    public function targetForPlugin()
    {
        echo "i am target for plugin (+)";
    }
}
