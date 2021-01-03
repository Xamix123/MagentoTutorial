<?php

namespace Learning\AdminGrid\Block\Adminhtml;

use Magento\Backend\Block\Widget\Container;
use Magento\Backend\Block\Widget\Context;

class Grid extends Container
{
    /**
     * @var string
     */
    protected $_template = 'grid/view.phtml';

    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * {@inheritdoc}
     */
    protected function _prepareLayout()
    {
        //add Button
        $addButtonProps = [
            'id' =>  'add_new_grid',
            'label' => __('Add New'), //add Button text
            'class' => 'primary', // add button class
            'class_name' => 'Magento\Backend\Block\Widget\Button', // our button Magento class
            'onclick' => "setLocation('" . $this->_getCreateUrl() . "')" // button url
        ];
        $this->buttonList->add('add_new', $addButtonProps); // add new button with id add_new

        return parent::_prepareLayout();
    }

    /**
     * @return string
     */
    protected function _getCreateUrl()
    {
        return $this->getUrl('admingrid/*/new'); // get create url
    }

    /**
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid'); // get grid html
    }
}
