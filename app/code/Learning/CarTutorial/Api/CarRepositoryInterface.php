<?php

namespace Learning\CarTutorial\Api;

use Learning\CarTutorial\Api\Data\CarInterface;
use Learning\CarTutorial\Api\Data\CarSearchResultsInterface;
use Learning\CarTutorial\Model\Car;
use Magento\Framework\Api\SearchCriteriaInterface;

interface CarRepositoryInterface
{

    /**
     * @param $id
     * @return CarInterface
     */
    public function getById($id);

    /**
     * @param Car $car
     * @return bool
     */
    public function save(Car $car);

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
