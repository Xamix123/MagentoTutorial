<?php

namespace Learning\CarTutorial\Model;

use Learning\BackendPlugins\Model\Interfaces\Task4\BackendModelObjectInterface;
use Learning\CarTutorial\Model\ResourceModel\Car as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Car extends AbstractModel implements BackendModelObjectInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function test()
    {
        echo " i am in car class";
    }

    public function getModelObject(): Car
    {
        return $this;
    }
}
