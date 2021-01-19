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

        $this->_controller = 'adminhtml_grid'; // set controller
        $this->_blockGroup = 'Learning\AdminGrid'; // set block group
        parent::_construct();
    }

}
