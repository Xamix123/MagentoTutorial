<?php

namespace Learning\DeclarateSchema\Model;

use Magento\Framework\Model\AbstractModel;
use Learning\DeclarateSchema\Model\ResourceModel\TestModel as ResourceModel;

class TestModel extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
