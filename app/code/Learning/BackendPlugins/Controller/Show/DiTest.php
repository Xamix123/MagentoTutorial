<?php

namespace Learning\BackendPlugins\Controller\Show;

use Learning\BackendPlugins\Model\Interfaces\SomeTestInterface;
use Learning\BackendPlugins\Model\ModelA;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class DiTest extends Action
{
    private $backend;
    private $modelA;

    public function __construct(Context $context, SomeTestInterface $backend, ModelA $modelA)
    {
        $this->backend = $backend;
        $this->modelA = $modelA;

        parent::__construct($context);
    }

    public function execute()
    {
        $this->backend->someFunction();
        echo '<br>';
        $this->modelA->someFunction();
    }
}
