<?php

namespace Learning\CarTutorial\Controller\Car;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class CarList extends Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
