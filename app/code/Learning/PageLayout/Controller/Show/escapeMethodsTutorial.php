<?php

namespace Learning\PageLayout\Controller\Show;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class escapeMethodsTutorial extends Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

