<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Grid;

use Learning\AdminGrid\Model\AdminGridFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Session;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;

class Edit extends Action
{
    //this method use for edit and add new record in our DB

    //DI for $_coreRegistry $adminSession and $adminGridFactory
    /** @var Registry|null  */
    protected $_coreRegistry = null;

    /** @var Session  */
    protected $adminSession;

    /** @var AdminGridFactory  */
    protected $adminGridFactory;

    /**
     * Menu constructor.
     * @param Context $context
     * @param Registry $registry
     * @param Session $adminSession
     * @param AdminGridFactory $adminGridFactory
     */
    public function __construct(
        Context $context,
        Registry $registry,
        Session $adminSession,
        AdminGridFactory $adminGridFactory
    ) {
        $this->_coreRegistry = $registry;
        $this->adminSession = $adminSession;
        $this->adminGridFactory = $adminGridFactory;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return true;
    }


    /**
     * @return Page
     */
    protected function _initAction(): Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE); //create page
        $resultPage->setActiveMenu('Learning_AdminGrid::grid'); // Set Active sidebar
        return $resultPage;
    }

    /**
     * @return Page|ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {// set path to the redirect
        $id = $this->getRequest()->getParam('id'); // get param by key `id` from request
        $model = $this->adminGridFactory->create(); // create Model by adminGridFactory
        if ($id) { // if we have $id we doing update already exists data
            $model->load($id); // get data by id from db
            if (!$model->getId()) { // if data don`t have id this record already delete or data is broken
                $this->messageManager->addError(__('This record does not exist')); // return message this record does not exist
                $resultRedirect = $this->resultRedirectFactory->create(); // create object resultRedirect for redirect on page
                return $resultRedirect->setPath('*/*/'); // use redirect to root
            }
        }
        $data = $this->adminSession->getFormData(true); // get Form data from admin Session
        if (!empty($data)) { // if data is not empty
            $model->setData($data); //set data to our model
        }

        $this->_coreRegistry->register('learning_adminGrid_form_data', $model);
        $resultPage = $this->_initAction();

        $resultPage->getConfig()->getTitle()->prepend($model->getId() // check we have module id
            ? $model->getTitle() // if we have module id use Title like prefix
            : __('New Record')); // if we don`t have module id use phrase New Record
        return $resultPage; // return result page object
    }
}
