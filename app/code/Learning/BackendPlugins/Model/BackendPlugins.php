<?php

namespace Learning\BackendPlugins\Model;

use Learning\BackendPlugins\Model\Interfaces\BackendModelObjectInterface;
use Learning\BackendPlugins\Model\ResourceModel\BackendPlugins as ResourceModel;
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
