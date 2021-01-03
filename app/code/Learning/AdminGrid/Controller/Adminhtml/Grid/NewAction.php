<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;

class NewAction extends Action
{
    //Controller triggered when we click Add new

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory; // DI to the result forward factory

    public function __construct(
        Context $context,
        ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * Create new recording
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create(); // create result forward object
        return $resultForward->forward('edit'); // go to the action Edit( Learning/AdminGrid/Controller/Adminhtml/Grid
    }
}
