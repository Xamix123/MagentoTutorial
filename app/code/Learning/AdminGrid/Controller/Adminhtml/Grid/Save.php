<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Grid;

use Carbon\Carbon;
use Exception;
use Learning\AdminGrid\Exception\FieldIsNotValidException;
use Learning\AdminGrid\Model\AdminGridFactory;
use Learning\AdminGrid\Model\ResourceModel\AdminGrid;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Auth\Session;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use RuntimeException;

class Save extends Action
{
    /**
     * @var Session
     */
    protected $_adminSession;

    /**
     * @var AdminGridFactory
     */
    protected $adminGridFactory;

    /**
     * @var AdminGrid
     */
    protected $resourceModel;

    public function __construct(
        Context $context,
        Session $adminSession,
        AdminGridFactory $adminGridFactory,
        AdminGrid $resourceModel
    ) {
        parent::__construct($context);
        $this->_adminSession = $adminSession;
        $this->adminGridFactory = $adminGridFactory;
        $this->resourceModel = $resourceModel;
    }

    public function _construct()
    {
        date_default_timezone_set('Europe/Kiev'); // setData default timezone
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $postObj = $this->getRequest()->getPostValue(); // get value from post request

//        $date = Carbon::now(); // get current date time use Carbon library

        $data = array_merge($postObj, ['created_at' => "2020-12-22 05:01:52"]); // merge userDetail data with post request data
        $resultRedirect = $this->resultRedirectFactory->create(); // create redirect

        if ($data) { // if data is not null
            $model = $this->adminGridFactory->create(); // create model
            $id = $this->getRequest()->getParam('id'); // get id param from request

            if ($id) { // if id is not null
                $this->resourceModel->load($model, $id); // load data from DB
            }

            if($model->getStatus()) { // is status = disable
                $model->setStatus($data['status']); // change only status
            } else {
                $model->setData($data); // set data to the object
            }


            try {
                $this->resourceModel->save($model); // save data in DB
                $this->messageManager->addSuccess(__('The data has been saved')); // add message if data was saved success
                $this->_adminSession->setFormData(false); // remove form data
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath(
                        'adminhtml/*/edit', // set path to the redirect
                        ['id' => $model->getId(), '_current' => true] // add param to the redirect
                    );
                }
                return $resultRedirect->setPath('*/*/'); // set path to the redirect
            } catch (FieldIsNotValidException | LocalizedException | RuntimeException $e) {
                $this->messageManager->addError($e->getMessage()); // if catch exception show message
            } catch (Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.')); // if catch exception show message
            }
            $this->_getSession()->setFormData($data); // if save is not success redirect to edit page with form data
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
    }
}
