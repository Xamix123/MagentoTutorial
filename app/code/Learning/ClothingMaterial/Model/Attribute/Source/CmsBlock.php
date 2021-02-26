<?php

namespace Learning\ClothingMaterial\Model\Attribute\Source;

use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\ResourceModel\Block\CollectionFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class CmsBlock extends AbstractSource
{
    private $collectionBlockFactory;
    protected $_options;

    public function __construct(
        CollectionFactory $collectionBlockFactory
    ) {
        $this->collectionBlockFactory = $collectionBlockFactory;
    }

    /**
     * Get All options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        if (!$this->_options) {
            $collection = $this->collectionBlockFactory->create();
            $this->_options = $collection->toOptionArray();
        }
        return $this->_options;
    }
}
