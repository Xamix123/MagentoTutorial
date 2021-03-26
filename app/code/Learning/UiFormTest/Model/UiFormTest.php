<?php

namespace Learning\UiFormTest\Model;

use Learning\UiFormTest\Model\ResourceModel\UiFormTest as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class UiFormTest extends AbstractModel
{
    const STATUSES = [
        'false' => false,
        'true' => true
    ];

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
