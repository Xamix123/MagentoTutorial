<?php

namespace Learning\ClothingMaterial\Block;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\View\Element\Template;

class CategoryFront extends FrontendModelShow
{
    const NAME_ATTRIBUTE = "test_customer_ui_attribute";
    const TITLE = "Category";

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryFront constructor.
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        Category $category,
        array $data = []
    ) {
        $this->category = $category;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getAdditionalData() :array
    {
        $data = [];
        $collection = $this->collectionFactory->create();

//        return parent::getAdditionalDataFromCollection($collection, $this->category);
        return [];
    }
}
