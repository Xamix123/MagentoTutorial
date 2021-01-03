<?php

namespace Learning\Faq\Model\ResourceModel\Faq;

use Learning\Faq\Model\Faq as Model;
use Learning\Faq\Model\ResourceModel\Faq as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
