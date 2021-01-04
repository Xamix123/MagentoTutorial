<?php

namespace Learning\AdminGrid\Block\Adminhtml;

use Magento\Backend\Block\Widget\Button;
use Magento\Backend\Block\Widget\Grid\Container;
use Magento\Backend\Block\Widget\Context;

class Grid extends Container
{

    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        //add Button

        $this->_blockGroup = 'Learning_AdminGrid'; // set block group
        $this->_controller = 'Adminhtml_Grid'; // set controller

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
