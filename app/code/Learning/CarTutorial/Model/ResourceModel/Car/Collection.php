<?php

namespace Learning\CarTutorial\Model\ResourceModel\Car;

use Learning\CarTutorial\Model\Car as Model;
use Learning\CarTutorial\Model\ResourceModel\Car as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
