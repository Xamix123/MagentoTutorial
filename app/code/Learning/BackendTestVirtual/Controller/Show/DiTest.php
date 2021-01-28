<?php

namespace Learning\BackendTestVirtual\Controller\Show;

use Learning\BackendTestVirtual\Model\ModelB;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class DiTest extends Action
{
    private $modelB;

    public function __construct(Context $context, ModelB $modelB)
    {
        $this->modelB = $modelB;

        parent::__construct($context);
    }

    public function execute()
    {
        echo " i am in virtualTest class";
    }
}
