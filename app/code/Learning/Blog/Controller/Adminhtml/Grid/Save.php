<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Created By : Rohan Hapani
 */
namespace Learning\Blog\Controller\Adminhtml\Grid;

use Exception;
use Learning\Blog\Model\BlogFactory;
use Magento\Backend\App\Action;
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
     * @var BlogFactory
     */
    protected $blogFactory;
    /**
     * @param Action\Context                      $context
     * @param Session $adminSession
     * @param BlogFactory          $blogFactory
     */
    public function __construct(
        Action\Context $context,
        Session $adminSession,
        BlogFactory $blogFactory
    ) {
        parent::__construct($context);
        $this->_adminSession = $adminSession;
        $this->blogFactory = $blogFactory;
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\Result\Redirect|ResultInterface
     */
    public function execute()
    {
        $postObj = $this->getRequest()->getPostValue();
        $name = $postObj["name"];
        $date = date("Y-m-d");
        $username = $this->_adminSession->getUser()->getFirstname();
        if ($username == $name) {
            $username = $this->_adminSession->getUser()->getFirstname();
        } else {
            $username = $name;
        }
        $userDetail = ["name" => $username, "created_at" => $date];
        $data = array_merge($postObj, $userDetail);
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->blogFactory->create();
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
            $model->setData($data);
            try {
                $model->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->_adminSession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('blog/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
