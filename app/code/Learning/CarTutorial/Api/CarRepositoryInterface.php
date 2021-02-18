<?php

namespace Learning\CarTutorial\Api;

use Learning\CarTutorial\Api\Data\CarInterface;
use Learning\CarTutorial\Api\Data\CarSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface CarRepositoryInterface
{

    /**
     * @param $id
     * @return CarInterface
     */
    public function getById($id);

    /**
     * @param CarInterface $car
     * @return bool
     */
    public function save(CarInterface $car);

    /**
     * @param $id
     * @return bool
     */
    public function deleteById($id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return CarSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
