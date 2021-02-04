<?php /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Learning\FirstUnit\Controller\ControllerTest;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class View extends Action
{
    private $productRepository;

    private $filter;

    private $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        FilterBuilder $filter,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->productRepository = $productRepository;
        $this->filter = $filter;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        parent::__construct($context);
    }

    public function execute()
    {
        $filter = $this->filter->setField(ProductInterface::NAME)
                                ->setValue('%test%')
                                ->setConditionType('like')
                                ->create();

        $this->searchCriteriaBuilder->addFilters([$filter]);
        $this->searchCriteriaBuilder->setPageSize(20);

        $searchCriteria = $this->searchCriteriaBuilder->create();

        $data = $this->productRepository->getList($searchCriteria)->getItems();

        foreach ($data as $item) {
            echo "Sku: " . $item->getSku() . " -  Name: " . $item->getName();
            echo '<br>';
        }
    }
}
