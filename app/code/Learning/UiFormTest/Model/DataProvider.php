<?php

namespace Learning\UiFormTest\Model;

use Magento\Framework\Api\Filter;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return [];
    }

    public function addFilter(Filter $filter)
    {
        return null;
    }
}
