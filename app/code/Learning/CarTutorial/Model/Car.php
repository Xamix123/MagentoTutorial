<?php

namespace Learning\CarTutorial\Model;

use Learning\CarTutorial\Api\Data\CarInterface;
use Learning\CarTutorial\Model\ResourceModel\Car as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Car extends AbstractModel implements CarInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->getData(self::CAR_ID);
    }

    /**
     * @param int $value
     * @return CarInterface
     */
    public function setId($value): CarInterface
    {
        $this->setData(self::CAR_ID, $value);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getManufacturer(): ?string
    {
        return $this->getData(self::MANUFACTURER);
    }

    /**
     * @param string $value
     * @return CarInterface
     */
    public function setManufacturer($value): CarInterface
    {
        $this->setData(self::MANUFACTURER, $value);
        return $this;
    }

    /**
     * @param string $value
     * @return CarInterface
     */
    public function setModel($value): CarInterface
    {
        $this->setData(self::MODEL, $value);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->getData(self::MODEL);
    }
}
