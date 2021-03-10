<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Framework\App\RequestInterface;

class Send extends Action
{
    private $request;

    public function __construct(
        Action\Context $context,
        RequestInterface $request
    ) {
        $this->request = $request;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->request->getParams();
        var_export($data);
        echo 'its works halliluya<br>';
    }
}
