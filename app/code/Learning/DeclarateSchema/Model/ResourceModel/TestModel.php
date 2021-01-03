<?php

namespace Learning\DeclarateSchema\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class TestModel extends AbstractDb
{
    public function _construct()
    {
        $this->_init("rh_helloworld", 'id');
    }
}
