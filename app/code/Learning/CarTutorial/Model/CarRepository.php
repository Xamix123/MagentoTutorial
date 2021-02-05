<?php

namespace Learning\CarTutorial\Model;

use Learning\CarTutorial\Api\CarRepositoryInterface;
use Learning\CarTutorial\Model\ResourceModel\Car\Collection;
use Learning\CarTutorial\Model\ResourceModel\Car\CollectionFactory as CarCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;

class CarRepository implements CarRepositoryInterface
{
    private $collectionFactory;

    public function __construct(
        CarCollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);

        $collection->load();

        foreach ($collection->getItems() as $item) {
            var_export($item->toString());
            echo "<br>";
        }
    }

    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }
}
