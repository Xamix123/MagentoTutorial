<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Framework\App\RequestInterface;

class Send extends Action
{
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        var_export($data);die();
        echo 'its works halliluya<br>';
    }
}
