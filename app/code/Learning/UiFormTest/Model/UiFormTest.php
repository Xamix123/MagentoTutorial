<?php

namespace Learning\UiFormTest\Model;

use Magento\Framework\Model\AbstractModel;
use Learning\UiFormTest\Model\ResourceModel\UiFormTest as ResourceModel;

class UiFormTest extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
