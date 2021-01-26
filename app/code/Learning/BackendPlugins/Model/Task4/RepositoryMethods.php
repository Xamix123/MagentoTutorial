<?php

namespace Learning\BackendPlugins\Model\Task4;

use Learning\BackendPlugins\Model\Interfaces\Task4\BackendModelObjectInterface;
use Learning\BackendPlugins\Model\Interfaces\Task4\BackendPluginsInterface;
use Magento\Framework\Event\ManagerInterface as EventManager;

class RepositoryMethods implements BackendPluginsInterface
{
    private $customModel;
    private $eventManager;

    /**
     * RepositoryMethods constructor.
     * @param BackendModelObjectInterface $customModel
     * @param EventManager $eventManager
     */
    public function __construct(BackendModelObjectInterface $customModel, EventManager $eventManager)
    {
        $this->customModel = $customModel;
        $this->eventManager = $eventManager;
    }

    public function createTable()
    {
        $modelObject = $this->customModel->getModelObject();
        $this->getList($modelObject);
    }

    /**
     * @param $object
     */
    public function getList($object)
    {
        $collection =  $object->getCollection();
        $fieldNames = $this->getFieldsName($collection);
        $this->removeEmptyFields($collection, $fieldNames);
        $this->eventManager->dispatch(
            'learning_backendplugins_model_getTableData',
            [
                'fieldsNames' => $fieldNames
            ]
        );

        foreach ($collection as $row) {
            $this->showItem($row->toArray());
        }
    }

    /**
     * @param $row
     */
    public function showItem($row)
    {
        foreach ($row as $item) {
            echo '<td>' . $item . '</td>';
        }
    }

    /**
     * @param $collection
     * @param $fieldNames
     */
    public function removeEmptyFields($collection, $fieldNames)
    {
        foreach ($fieldNames as $fieldName) {
            $collection->addFieldToFilter($fieldName, ['neq' => null]);
        }
    }

    /**
     * @param $collection
     * @return array
     */
    private function getFieldsName($collection): array
    {
        $fields = $collection->getConnection()->describeTable($collection->getMainTable());
        $fieldsNames = [];
        $i = 0;
        foreach ($fields as $id => $data) {
            $fieldsNames[$i] = $id;
            $i++;
        }

        return $fieldsNames;
    }
}
