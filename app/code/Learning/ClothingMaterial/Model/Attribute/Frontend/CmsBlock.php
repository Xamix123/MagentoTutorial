<?php

namespace Learning\ClothingMaterial\Model\Attribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Framework\DataObject;

class CmsBlock extends AbstractFrontend
{
    public function getValue(DataObject $object)
    {
        return '<i> You simple guy and understand this</i>';
    }
}
