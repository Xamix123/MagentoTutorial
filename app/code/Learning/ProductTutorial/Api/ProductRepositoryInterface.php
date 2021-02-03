<?php

namespace Learning\ProductTutorial\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ProductRepositoryInterface
{
    public function getList(SearchCriteriaInterface $searchCriteria);
}
