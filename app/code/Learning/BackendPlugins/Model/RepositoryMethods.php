<?php

namespace Learning\BackendPlugins\Model;

use Learning\BackendPlugins\Model\Interfaces\BackendModelObjectInterface;
use Learning\BackendPlugins\Model\Interfaces\BackendPluginsInterface;
use Magento\Framework\Event\ManagerInterface as EventManager;

class RepositoryMethods implements BackendPluginsInterface
{
    private $customModel;
    private $eventManager;

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

    public function getList($object)
    {
        $collection =  $object->getCollection();
        $fieldNames = $this->getFieldsName($collection);
        $collection->addFieldToFilter($fieldNames, ['null' => true]);
        $this->eventManager->dispatch(
            'learning_backendplugins_model_getTableData',
            [
                'fieldsNames' => $fieldNames
            ]
        );

        foreach ($collection as $item) {
            $this->showItem($item);
        }
    }

    public function showItem($item)
    {
        foreach ($item->toArray() as $data) {
            echo '<td>' . $data . '</td>';
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
