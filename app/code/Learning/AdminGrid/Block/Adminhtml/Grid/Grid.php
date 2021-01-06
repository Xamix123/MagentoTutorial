<?php

namespace Learning\AdminGrid\Block\Adminhtml\Grid;

use Learning\AdminGrid\Model\AdminGrid;
use Learning\AdminGrid\Model\AdminGridFactory;
use Learning\AdminGrid\Model\ResourceModel\AdminGrid\CollectionFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data;
use Magento\Catalog\Model\Product;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Module\Manager;

class Grid extends Extended
{
    // this block created Grid with the specified structure

    //DI for $_status $_adminGridFactory and ModuleManager

    /**
     * @var AdminGridFactory
     */
    protected $_adminGridFactory;

    /**
     * @var Manager
     */
    protected $moduleManager;

    /** @var CollectionFactory $collectionFactory */
    protected $collectionFactory;

    /**
     * Grid constructor.
     * @param Context $context
     * @param Data $backendHelper
     * @param AdminGridFactory $adminGridFactory
     * @param CollectionFactory $collectionFactory
     * @param Manager $moduleManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $backendHelper,
        AdminGridFactory $adminGridFactory,
        CollectionFactory $collectionFactory,
        Manager $moduleManager,
        array $data = []
    ) {
        $this->_adminGridFactory = $adminGridFactory;
        $this->moduleManager = $moduleManager;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('gridGrid'); // grid ID
        $this->setDefaultSort('id'); //default field for sort
        $this->setDefaultDir('DESC'); //default sort direction
        $this->setSaveParametersInSession(true); //when this parameter is enable grid parameters saved in the session
        $this->setUseAjax(true); //if i delete this styles go away~~~
        $this->setVarNameFilter('grid_record');// key filter request
    }

    /**
     * @return $this
     */
    protected function _prepareCollection(): Grid
    {
        $collection = $this->collectionFactory->create(); // create resource model by ResourceModel Factory and getCollection
        $this->setCollection($collection); // setCollection to $this object of (Magento\Backend\Block\Widget\Grid\Extended)
        parent::_prepareCollection();// call parent _prepareCollection method of class (Magento\Backend\Block\Widget\Grid\Extended)
        return $this;
    }

    /**
     * @return Grid
     * @throws LocalizedException
     */
    protected function _prepareColumns(): Grid
    {
        $this->addColumn(
            'id',
            [
              'header' => __('ID'), // header text data
              'type' => 'number', // type column data
              'index' => 'id', // index column
              'header_css_class' => 'col-id', // css class which will be use in the header of our ID column
              'column_css_class' => 'col-id'  // css class which will be use in the column data of our ID column
          ]
        );

        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name'
            ]
        );

        $this->addColumn(
            'email',
            [
                'header' => __('Email'), // header text data
                'index' => 'email' // index for collection
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('Title'), // header text data
                'index' => 'title' // index for collection
            ]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('Status'), // header text data
                'index' => 'status', // index column
                'type' => 'options', // type of column
                'options' => AdminGrid::STATUSES_ARRAY, // option value
            ]
        );

        $this->addColumn(
            'created_at',
            [
                'header' => __('Created At'), // header text data
                'index' => 'created_at' // index column
            ]
        );

        $this->addColumn(
            'edit',
            [
                'header' => __('Menu'), // header text data
                'type' => 'action', // type of column
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Change Data'), //button text
                        'url' => [
                            'base' => 'admingrid/*/edit', // module name / *(route) / controller
                        ],
                        'field' => 'id',
                    ]
                ],
                'filter' => false, // don`t have filter field on
                'sortable' => false, //don`t sorting
                'index' => 'stores' // TODO check this field
            ]
        );

        $this->addColumn(
            'delete',
            [
                'header' => __('Delete'), //column name
                'type' => 'action', // column type
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Delete'), //button text
                        'url' => [
                            'base' => 'admingrid/*/delete', // module name / *(route) / controller
                        ],
                        'field' => 'id' // TODO check this field
                    ],
                ],
                'filter' => false, // don`t have filter field on
                'sortable' => false, //don`t sorting
                'index' => 'stores',
                'header_css_class' => 'col-action', // css for header
                'column_css_class' => 'col-action', // css for column
            ]
        );

        $block = $this->getLayout()->getBlock('grid.bottom.links'); // add bottom links for padding
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }
        return parent::_prepareColumns();
    }

    //function for mass actions and for select above grid
    /**
     * @return $this|Grid
     */
    protected function _prepareMassaction(): Grid
    {
        $this->setMassactionIdField('id');
        $this->setMassactionBlock()->setFormFieldName('id');
        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'), //select box text
                'url' => $this->getUrl('admingrid/*/massDelete'), //controller action for massDelete method
                'confirm' => __('Are you sure?'), //text of confirm popup
            ]
        );

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),//select box text
                'url' => $this->getUrl('admingrid/*/massStatus', ['_current' => true]), //controller action for massStatus method
                'additional' => [
                    'visibility' => [
                        'name' => 'status', // name status select box
                        'type' => 'select', // type of status select box
                        'class' => 'required-entry',
                        'label' => __('Status'), // label on status select box
                        'values' => AdminGrid::STATUSES_ARRAY
                    ],
                ],
            ]
        );

        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl(): string
    {
        return $this->getUrl('admingrid/*/grid', ['_current' => true]);
    }

    /**
     * @param Product|DataObject $item
     * @return string
     */
    public function getRowUrl($item): string
    {
        return $this->getUrl('admingrid/*/edit', ['id' => $item->getId()]);
    }
}
