<?php

namespace Learning\CarTutorial\Model\Api\SearchCriteria\CollectionProcessor\FilterProcessor;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor\FilterProcessor\CustomFilterInterface;
use Magento\Framework\Data\Collection\AbstractDb;

class CarFilter implements CustomFilterInterface
{
    public function apply(Filter $filter, AbstractDb $collection): bool
    {
        $value = $filter->getValue();
        $conditionType = $filter->getConditionType() ?: 'in';
        $filterValue = [$value];

        if (($conditionType === 'in' || $conditionType === 'nin') && is_string($value)) {
            $filterValue = explode(',', $value);
        }

        $carFilter = [$conditionType => $filterValue];

        return true;
    }
}
