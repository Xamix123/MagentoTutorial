<?php

namespace Learning\ScriptsLearning\Model;

use Magento\Framework\Model\AbstractModel;

class Somemodel extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Learning\ScriptsLearning\Model\ResourceModel\Somemodel');
    }
}

