<?php

namespace Learning\ClothingMaterial\Model\Attribute\Source;

use Magento\Cms\Model\BlockFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CmsBlock extends AbstractSource
{
    private $blockFactory;
    protected $_options;

    public function __construct(
        BlockFactory $blockFactory
    ) {
        $this->blockFactory = $blockFactory;
    }

    /**
     * Get All options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        if (!$this->_options) {
            $this->_options =  $this->blockFactory->create()
              ->getCollection()
              ->load()
              ->toOptionArray();
        }
        return $this->_options;
    }
}
