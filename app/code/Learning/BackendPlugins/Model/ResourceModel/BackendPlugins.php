<?php

namespace Learning\BackendPlugins\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BackendPlugins extends AbstractDb
{
    public function _construct()
    {
        $this->_init('testDataPlugin', 'id');
    }
}



