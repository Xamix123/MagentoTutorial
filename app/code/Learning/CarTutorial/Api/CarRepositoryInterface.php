<?php

namespace Learning\CarTutorial\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CarRepositoryInterface
{
    public function getList(SearchCriteriaInterface $searchCriteria);
}

