<?php

namespace Learning\CarTutorial\Model;

use Learning\CarTutorial\Api\CarRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class CarRepository implements CarRepositoryInterface
{
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        var_export("i am here");
    }
}
