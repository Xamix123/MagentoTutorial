<?php

namespace Learning\AdminGrid\Model;

use Learning\AdminGrid\Model\ResourceModel\AdminGrid as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class AdminGrid extends AbstractModel
{
    public const STATUS_DISABLE = 0;
    public const STATUS_ENABLE = 1;

    public const STATUSES_ARRAY = [
        self::STATUS_DISABLE => 'Disabled',
        self::STATUS_ENABLE => 'Enabled'
    ];

    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

}
