<?php

namespace Learning\ClothingMaterial\Model\Attribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Framework\DataObject;

class Customer extends AbstractFrontend
{
    /**
     * @param DataObject $object
     * @return string
     */
    public function getValue(DataObject $object): string
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        return "<b>$value</b>";
    }
}
