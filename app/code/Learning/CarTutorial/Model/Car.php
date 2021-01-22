<?php

namespace Learning\CarTutorial\Model;

use Learning\BackendPlugins\Model\BackendPluginsInterface;
use Learning\CarTutorial\Model\ResourceModel\Car as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Car extends AbstractModel implements BackendPluginsInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function test()
    {
        echo " i am in car class";
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
