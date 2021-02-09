<?php

namespace Learning\BackendPlugins\Model\Task4;

use Learning\BackendPlugins\Model\Interfaces\Task4\BackendModelObjectInterface;
use Learning\BackendPlugins\Model\Task4\ResourceModel\BackendPlugins as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class BackendPlugins extends AbstractModel implements BackendModelObjectInterface
{
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getModelObject(): BackendPlugins
    {
        return $this;
    }
}
