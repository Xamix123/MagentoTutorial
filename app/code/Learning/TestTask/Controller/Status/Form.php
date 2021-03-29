<?php

namespace Learning\TestTask\Controller\Status;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Form extends Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
