<?php

namespace Learning\BackendPlugins\Model\ResourceModel\BackendPlugins;

use Learning\BackendPlugins\Model\BackendPlugins;
use Learning\BackendPlugins\Model\ResourceModel\BackendPlugins as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(BackendPlugins::class, ResourceModel::class);
    }
}
