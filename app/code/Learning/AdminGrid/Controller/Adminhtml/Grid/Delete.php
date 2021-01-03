<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Grid;

use Exception;
use Learning\AdminGrid\Model\AdminGridFactory;
use Learning\AdminGrid\Model\ResourceModel\AdminGrid;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action
{

    /**
     * @var AdminGridFactory
     */
    protected $adminGridFactory;

    /**
     * @var AdminGrid
     */
    private $resourceModel;

    public function __construct(
        Context $context,
        AdminGridFactory $adminGridFactory,
        AdminGrid $resourceModel
    ) {
        parent::__construct($context);
        $this->adminGridFactory = $adminGridFactory;
        $this->resourceModel = $resourceModel;
    }

    /**
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Learning_AdminGrid::view');
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id'); // get Param from Request by key id
        $resultRedirect = $this->resultRedirectFactory->create(); // create redirect
        if ($id) { // if id is not null
            try {
                $model = $this->adminGridFactory->create();

                $this->resourceModel->load($model, $id); //load data from BD
                $this->resourceModel->delete($model); // delete data

                $this->messageManager->addSuccess(__('The record has been deleted.')); // message for success delete
                return $resultRedirect->setPath('*/*/'); // set path for redirect
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage()); // if we get error show it`s
                return $resultRedirect->setPath('*/*/index', ['id' => $id]); // set path for redirect
            }
        }
        $this->messageManager->addError(__('We can\'t find a record to delete.')); // if id == null add error message we can`t delete
        return $resultRedirect->setPath('*/*/'); // set path for redirect
    }
}
