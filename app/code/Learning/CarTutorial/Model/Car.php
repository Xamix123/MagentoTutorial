<?php

namespace Learning\CarTutorial\Model;

use Magento\Framework\Model\AbstractModel;
use Learning\CarTutorial\Model\ResourceModel\Car as ResourceModel;

class Car extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
