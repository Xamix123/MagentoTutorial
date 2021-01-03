<?php

namespace Learning\CarTutorialOld\Model;

use Magento\Framework\Model\AbstractModel;
use Learning\CarTutorialOld\Model\ResourceModel\Car as ResourceModel;

class Car extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
