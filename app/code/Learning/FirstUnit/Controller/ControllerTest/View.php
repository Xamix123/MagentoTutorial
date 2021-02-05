<?php /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Learning\FirstUnit\Controller\ControllerTest;

use Learning\CarTutorial\Api\CarRepositoryInterface;
use Learning\CarTutorial\Api\Data\CarInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class View extends Action
{
    private $productRepository;

    private $carRepository;

    private $filter;

    private $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        CarRepositoryInterface $carRepository,
        FilterBuilder $filter,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->productRepository = $productRepository;
        $this->carRepository = $carRepository;
        $this->filter = $filter;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        parent::__construct($context);
    }

    public function execute()
    {

        /* Task 1-5 get active product data*/
        //---------------------------------------TASK 1-----------------------------------------------//
        $filter = $this->filter->setField(ProductInterface::NAME)
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
        echo '<br> <strong>TASK 2</strong> <br>';
        $newFilter = $this->filter->setField(CarInterface::MODEL)
            ->setValue('%ford%')
            ->setConditionType('like')
            ->create();

        $this->searchCriteriaBuilder->addFilters([$newFilter]);
        $this->searchCriteriaBuilder->setPageSize(20);

        $searchCriteriaCar = $this->searchCriteriaBuilder->create();

        $data = $this->carRepository->getList($searchCriteriaCar)->getItems();

        foreach ($data as $item) {
            echo 'Model: ' . $item->getModel() . ' -  Manufacturer: ' . $item->getManufacturer();
            echo '<br>';
        }
    }
}
