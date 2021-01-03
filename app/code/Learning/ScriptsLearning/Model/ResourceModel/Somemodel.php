<?php

namespace Learning\ScriptsLearning\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Somemodel extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('test_scripts_learning', 'learning_id');
    }
}
