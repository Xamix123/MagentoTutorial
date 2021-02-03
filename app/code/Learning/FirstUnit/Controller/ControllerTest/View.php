<?php /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Learning\FirstUnit\Controller\ControllerTest;

use Learning\ProductTutorial\Api\ProductRepositoryInterface;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class View extends Action
{
    private $product;

    private $filter;

    private $filterGroup;

    private $searchCriteria;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $product,
        Filter $filter,
        FilterGroup $filterGroup,
        SearchCriteriaInterface $searchCriteria
    ) {
        $this->product = $product;
        $this->filter = $filter;
        $this->filterGroup = $filterGroup;
        $this->searchCriteria = $searchCriteria;

        parent::__construct($context);
    }

    public function execute()
    {
        $filter =  $this->filter->setField('name')
                                ->setValue('%test%')
                                ->setConditionType('like');

        $filterGroup = $this->filterGroup->setFilters([$filter]);

        $this->searchCriteria->setFilterGroups([$filterGroup]);

        $this->product->getList($this->searchCriteria);
    }
}
