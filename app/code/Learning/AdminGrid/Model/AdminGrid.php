<?php

namespace Learning\AdminGrid\Model;

use Learning\AdminGrid\Model\ResourceModel\AdminGrid as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class AdminGrid extends AbstractModel
{
    public const STATUSES_ARRAY = [0 => 'Enabled', 1 => 'Disabled'];

    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

}
