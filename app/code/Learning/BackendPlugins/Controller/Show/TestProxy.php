<?php

namespace Learning\BackendPlugins\Controller\Show;

use Learning\BackendPlugins\Model\Task9\FastLoading;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class TestProxy extends Action
{
    private $fastLoading;

    public function __construct(
        Context $context,
        FastLoading $fastLoading
    ) {
        $this->fastLoading = $fastLoading;
        parent::__construct($context);
    }

    public function execute()
    {
        echo $this->fastLoading->getFastValue();
    }
}
