<?php

namespace Learning\AdminGrid\Model\ResourceModel\AdminGrid;

use Learning\AdminGrid\Model\AdminGrid;
use Learning\AdminGrid\Model\ResourceModel\AdminGrid as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(AdminGrid::class, ResourceModel::class);
    }
}
