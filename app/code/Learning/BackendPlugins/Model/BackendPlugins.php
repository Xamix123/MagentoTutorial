<?php

namespace Learning\BackendPlugins\Model;

use Learning\BackendPlugins\Model\ResourceModel\BackendPlugins as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class BackendPlugins extends AbstractModel implements BackendPluginsInterface
{
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getList()
    {
        $collection = $this->getCollection();
        foreach ($collection as $item) {
            $this->showItem($item);
        }
    }

    public function showItem($item)
    {
        foreach ($item->toArray() as $data) {
            echo '<td>' . $data . '</td>';
        }
    }
}
