<?php

namespace Learning\BackendPlugins\Model\Task4\ResourceModel\BackendPlugins;

use Learning\BackendPlugins\Model\Task4\ResourceModel\BackendPlugins as ResourceModel;
use Learning\BackendPlugins\Model\Task4\BackendPlugins;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(BackendPlugins::class, ResourceModel::class);
    }
}
