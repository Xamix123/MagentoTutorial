<?php /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Learning\FirstUnit\Controller\ControllerTest;

use Exception;
use Learning\CarTutorial\Api\CarRepositoryInterface;
use Learning\CarTutorial\Api\Data\CarInterface;
use Learning\CarTutorial\Model\Car;
use Learning\CarTutorial\Model\CarFactory;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class View extends Action
{
    private $productRepository;

    private $carRepository;

    private $carFactory;

    private $filterBuilder;

    private $filterGroupBuilder;

    private $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        CarRepositoryInterface $carRepository,
        CarFactory $carFactory,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->productRepository = $productRepository;
        $this->carRepository = $carRepository;
        $this->carFactory = $carFactory;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        parent::__construct($context);
    }

    public function execute()
    {
        /* Task 1-5 get active product data*/
        //---------------------------------------TASK 1-----------------------------------------------//
        $filter = $this->filterBuilder->setField(ProductInterface::NAME)
                                ->setValue('%test%')
                                ->setConditionType('like')
                                ->create();

        $this->searchCriteriaBuilder->addFilters([$filter]);
        $this->searchCriteriaBuilder->setPageSize(20);

        $searchCriteria = $this->searchCriteriaBuilder->create();

        $data = $this->productRepository->getList($searchCriteria)->getItems();

        foreach ($data as $item) {
            echo 'Sku: ' . $item->getSku() . ' -  Name: ' . $item->getName();
            echo '<br>';
        }
        //---------------------------------------TASK 1-----------------------------------------------//

        //additional work with search criteria
        //---------------------------------------TASK 1 - * ------------------------------------------//

        $filter1 = $this->filterBuilder->setField(ProductInterface::NAME)
            ->setValue('%test%')
            ->setConditionType('like')
            ->create();

        $this->filterGroupBuilder->setFilters([$filter1]);

        $filterGroup1 = $this->filterGroupBuilder->create();

        $filter2 = $this->filterBuilder->setField(ProductInterface::PRICE)
            ->setValue(300)
            ->setConditionType('lt')
            ->create();

        $this->filterGroupBuilder->setFilters([$filter2]);

        $filterGroup2 = $this->filterGroupBuilder->create();

        $this->searchCriteriaBuilder->setFilterGroups([$filterGroup1, $filterGroup2]);

        $searchCriteria2 = $this->searchCriteriaBuilder->create();

        $data = $this->productRepository->getList($searchCriteria2)->getItems();

        foreach ($data as $item) {
            echo 'Name: ' . $item->getName() . ' -> Price:' . $item->getPrice();
            echo '<br>';
        }
        //--------------------------------------------------------------------------------------------//

        /* Work with custom Repository*/
        //---------------------------------------TASK 2-----------------------------------------------//
        $this->workWithCustomRepository();
        //---------------------------------------TASK 2-----------------------------------------------//
    }

    /**
     * function for work with custom Repository
     */
    public function workWithCustomRepository()
    {
        try {
            echo '<br> <strong>TASK 2</strong> <br>';
            $newFilter = $this->filterBuilder->setField(CarInterface::MODEL)
                ->setValue('%ford%')
                ->setConditionType('like')
                ->create();

            $this->searchCriteriaBuilder->addFilters([$newFilter]);
            $this->searchCriteriaBuilder->setPageSize(20);

            $searchCriteriaCar = $this->searchCriteriaBuilder->create();

            echo 'GetData by id: ';
            $dataById = $this->carRepository->getById(11);
            $dataById->showCarData();

//            Delete functionality
//
//            if ($this->carRepository->deleteById(10)) {
//                echo 'Car was Delete Successfully<br>';
//            }

            /** @var CarInterface $car */
            $car = $this->carFactory->create();
            $car->setModel("testABCFord");
            $car->setManufacturer($dataById->getManufacturer());

            if ($this->carRepository->save($car)) {
                echo 'Car Added Successfully<br>';
            }
            $data = $this->carRepository->getList($searchCriteriaCar);

            foreach ($data->getItems() as $item) {
                echo 'ID:' . $item->getId() . ' - Model: ' . $item->getModel()
                    . ' -  Manufacturer: ' . $item->getManufacturer();
                echo '<br>';
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
