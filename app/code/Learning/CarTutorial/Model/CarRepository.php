<?php

namespace Learning\CarTutorial\Model;

use Exception;
use Learning\CarTutorial\Api\CarRepositoryInterface;
use Learning\CarTutorial\Api\Data\CarInterface;
use Learning\CarTutorial\Api\Data\CarSearchResultsInterface;
use Learning\CarTutorial\Api\Data\CarSearchResultsInterfaceFactory;
use Learning\CarTutorial\Model\ResourceModel\Car\Collection;
use Learning\CarTutorial\Model\ResourceModel\Car\CollectionFactory as CarCollectionFactory;
use Learning\CarTutorial\Model\ResourceModel\CarFactory as ResourceModelFactory;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class CarRepository implements CarRepositoryInterface
{
    private $carFactory;

    private $resourceCarFactory;

    private $collectionFactory;

    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     **/
    private $collectionProcessor;

    public function __construct(
        CarFactory $carFactory,
        ResourceModelFactory $resourceCarFactory,
        CarCollectionFactory $collectionFactory,
        CarSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->carFactory = $carFactory;
        $this->resourceCarFactory = $resourceCarFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * @param $id
     * @return CarInterface
     * @throws Exception
     */
    public function getById($id): CarInterface
    {
        $car = $this->carFactory->create();

        $resourceCar = $this->resourceCarFactory->create();
        $resourceCar->load($car, $id);
        if (! $car->getId()) {
            throw new Exception("Car does not exist", 404);
        }
        return $car;
    }

    /**
     * @param CarInterface $car
     * @return bool
     * @throws Exception
     */
    public function save(CarInterface $car): bool
    {
        $resourceCar = $this->resourceCarFactory->create();
        try {
            $resourceCar->save($car);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

        return true;
    }

    /**
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function deleteById($id): bool
    {
        $car = $this->carFactory->create();

        $resourceCar = $this->resourceCarFactory->create();
        $resourceCar->load($car, $id);
        if (! $car->getId()) {
            throw new Exception("Car does not exist", 404);
        }
        $resourceCar->delete($car);

        return true;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return CarSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->getCollectionProcessor()->process($searchCriteria, $collection);

        $collection->load();

        $searchResult = $this->searchResultsFactory->create();

        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }

    private function getCollectionProcessor(): CollectionProcessorInterface
    {
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                'Magento\Eav\Model\Api\SearchCriteria\CollectionProcessor'
            );
        }
        return $this->collectionProcessor;
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
