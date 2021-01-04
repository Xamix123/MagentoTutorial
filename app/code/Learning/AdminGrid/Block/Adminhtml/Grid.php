<?php

namespace Learning\AdminGrid\Block\Adminhtml;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Grid\Container;

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

        $this->_controller = 'Adminhtml_Grid'; // set controller
        $this->_blockGroup = 'Learning\AdminGrid'; // set block group
        parent::_construct();
    }

    /**
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid'); // get grid html
    }
}
