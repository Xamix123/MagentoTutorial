<?php

namespace Learning\ScriptsLearning\Model\ResourceModel\Somemodel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init(
           'Learning\ScriptsLearning\Model\Somemodel',
           'Learning\ScriptsLearning\Model\ResourceModel\Somemodel'
       );
    }
}
