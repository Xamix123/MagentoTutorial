<?php

namespace Learning\ClothingMaterial\Model\Attribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Framework\DataObject;

class Category extends AbstractFrontend
{
    const CUSTOM_STATUS = [
        '0' => false,
        '1' => true
    ];

    /**
     * @param DataObject $object
     * @return string
     */
    public function getValue(DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        $value =  $value === null
            ? '0'
            : $value;

        $checked = self::CUSTOM_STATUS[$value]
            ? 'checked'
            : "";

        return "<input id='check1' type='checkbox' " . $checked . "  />";
    }
}
