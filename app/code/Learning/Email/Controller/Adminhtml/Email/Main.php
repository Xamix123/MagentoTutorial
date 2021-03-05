<?php

namespace Learning\Email\Controller\Adminhtml\Email;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Main extends Action
{
    //use Dependency Injection to add $resultPageFactory

    /** @var PageFactory */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create(); // create new object Page
        $resultPage->setActiveMenu('Learning_AdminGrid::email'); // setActive menu
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Email')); // add title for start page

        return $resultPage; //return page
    }
}
