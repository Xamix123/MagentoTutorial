<?php

namespace Learning\UiFormTest\Model\ResourceModel\UiFormTest;

use Learning\UiFormTest\Model\UiFormTest as Model;
use Learning\UiFormTest\Model\ResourceModel\UiFormTest as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
