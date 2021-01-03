<?php

namespace Learning\CarTutorialOld\Model\ResourceModel\Car;

use Learning\CarTutorialOld\Model\Car as Model;
use Learning\CarTutorialOld\Model\ResourceModel\Car as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
