<?php

namespace Learning\ProductTutorial\Model;

use Learning\ProductTutorial\Api\ProductRepositoryInterface;
use Magento\Catalog\Ui\DataProvider\Product\ProductCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class ProductRepository implements ProductRepositoryInterface
{
    private $productCollectionFactory;

    private $collectionProcessor;

    public function __construct(
        ProductCollectionFactory $productCollectionFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->productCollectionFactory->create();
        foreach ($collection->getItems() as $id => $data) {
            echo $id . ' => ' . $data->toString() . '<br>';
        }
        echo '<br>___________________________________________<br>';

    }
}
