<?php

namespace Learning\PageLayout\Controller\Show;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class testArgument extends Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

