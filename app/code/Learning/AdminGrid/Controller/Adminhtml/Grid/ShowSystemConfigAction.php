<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Grid;

use Learning\AdminGrid\Helper\Data;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class ShowSystemConfigAction extends Action
{
    protected $helperData;

    public function __construct(
        Context $context,
        Data $helperData
    ) {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    public function execute()
    {
        echo $this->helperData->getGeneralConfig('enable');
        echo $this->helperData->getGeneralConfig('display_text');
        exit();
    }
}
