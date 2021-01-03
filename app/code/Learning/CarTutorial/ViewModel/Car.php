<?php

namespace Learning\CarTutorial\ViewModel;

use Learning\CarTutorial\Model\Car as CarModel;
use Learning\CarTutorial\Model\ResourceModel\Car as CarResource;
use Learning\CarTutorial\Model\ResourceModel\Car\CollectionFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Car implements ArgumentInterface
{
    private $car;

    /**
     * @var CarResource $carResource
     */
    private $carResource;

    private $collectionFactory;

    public function __construct(
        CarModel $car,
        CarResource $carResource,
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->car = $car;
        $this->carResource = $carResource;
    }

    public function getItems()
    {
        $collection = $this->collectionFactory->create();

        $collection->addFieldToFilter("manufacturer", ['neq' => ""]);
        $collection->addFieldToFilter("model", ['neq' => ""]);

        return $collection->getItems();
    }

    /**
     * @param $param
     * @return string
     * @throws AlreadyExistsException
     */
    public function addItem($param)
    {
        $carModel = $this->car;
        $carModel->setData($param);

        $this->carResource->save($carModel);

        return true;
    }
}
