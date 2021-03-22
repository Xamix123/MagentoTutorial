<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Created By : Rohan Hapani
 */
namespace Learning\Blog\Controller\Adminhtml\Grid;
use Learning\Blog\Model\BlogFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;

/**
 * Edit form Controller
 */
class Edit extends Action
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;
    /**
     * @var Session
     */
    protected $adminSession;
    /**
     * @var BlogFactory
     */
    protected $blogFactory;
    /**
     * @param Action\Context                 $context
     * @param Registry    $registry
     * @param Session $adminSession
     * @param BlogFactory     $blogFactory
     */
    public function __construct(
        Action\Context $context,
        Registry $registry,
        Session $adminSession,
        BlogFactory $blogFactory
    ) {
        $this->_coreRegistry = $registry;
        $this->adminSession = $adminSession;
        $this->blogFactory = $blogFactory;
        parent::__construct($context);
    }
    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * @return Page
     */
    protected function _initAction()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Learning_Blog::grid')->addBreadcrumb(__('Blog'), __('Blog'))->addBreadcrumb(__('Manage Blog'), __('Manage Blog'));
        return $resultPage;
    }

    /**
     * @return Page|ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->blogFactory->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This blog record no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->adminSession->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('learning_blog_form_data', $model);
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb($id ? __('Edit Post') : __('New Blog'), $id ? __('Edit Post') : __('New Blog'));
        $resultPage->getConfig()->getTitle()->prepend(__('Grids'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Blog'));
        return $resultPage;
    }
}
