<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Grid;

use Learning\AdminGrid\Model\ResourceModel\AdminGrid\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Setup\Exception;
use Magento\Ui\Component\MassAction\Filter;

class MassStatus extends Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $ids = $this->getRequest()->getPost('massaction');
        $status = $this->getRequest()->getPost('status');
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('id', ['in' => $ids]);
        $updateStatus = 0;
        try {
            foreach ($collection as $item) {
                $item->setStatus($status)->save();
                $updateStatus++;
            }
            $this->messageManager->addSuccess(__('A total of %1 record(s) have been updated.', $updateStatus));
        } catch (Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('Something went wrong while updating the product(s) status.')
            );
        }

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
    
}
