<?php

namespace Learning\ClothingMaterial\Block;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
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
     * @var CategoryRepository
     */
    private $categoryRepository;

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
        CategoryRepository $categoryRepository,
        array $data = []
    ) {
        $this->category = $category;
        $this->collectionFactory = $collectionFactory;
        $this->categoryRepository = $categoryRepository;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     * @throws NoSuchEntityException
     */
    public function getAdditionalData() :array
    {
        $data = [];
        $customData = [];
        $collection = $this->collectionFactory->create();

        foreach ($collection->getData() as $id => $item) {
            $entity = $this->categoryRepository->get($item['entity_id']);
            $customData[$id]['name'] = $entity->getName();
            $customData[$id]['value'] =
                $collection->getAttribute(static::NAME_ATTRIBUTE)->getFrontend()->getValue($entity);
        }

        return parent::getAdditionalDataFromCollection($collection, $customData);
    }
}
