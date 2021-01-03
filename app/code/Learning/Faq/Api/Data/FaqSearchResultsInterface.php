<?php

namespace Learning\Faq\Api\Data;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FaqSearchResultsInterface
{
    public function getItems();
    public function setItems(array $items);
    public function getSearchCriteria();
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria);
    public function getTotalCount();
    public function setTotalCount($totalCount);
}
