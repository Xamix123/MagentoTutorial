<?php

namespace Learning\BackendPlugins\Controller\Show;

use Learning\BackendPlugins\Model\BackendPluginsInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class VirtualTest extends Action
{
    private $backendPlugins;

    public function __construct(Context $context, BackendPluginsInterface $backendPlugins)
    {
        $this->backendPlugins = $backendPlugins;
        parent::__construct($context);
    }

    public function execute()
    {

        $this->testFunction();

        echo "i am here and i doing nothing";
    }

    public function testFunction()
    {
        $this->backendPlugins->getList();
    }
}
