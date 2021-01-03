<?php

namespace Learning\DeclarateSchema\Model\ResourceModel\TestModel;

use Learning\DeclarateSchema\Model\TestModel as Model;
use Learning\DeclarateSchema\Model\ResourceModel\TestModel as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
