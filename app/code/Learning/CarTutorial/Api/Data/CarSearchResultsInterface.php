<?php

namespace Learning\CarTutorial\Api\Data;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface CarSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return array
     */
    public function getItems();

    /**
     * @param array $items
     * @return CarSearchResultsInterface
     */
    public function setItems(array $items);

    /**
     * @return SearchCriteriaInterface
     */
    public function getSearchCriteria();

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return CarSearchResultsInterface
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria);

    /**
     * @return int
     */
    public function getTotalCount();

    /**
     * @param $totalCount
     * @return CarSearchResultsInterface
     */
    public function setTotalCount($totalCount);
}

