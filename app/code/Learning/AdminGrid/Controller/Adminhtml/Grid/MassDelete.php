<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Grid;

use Learning\AdminGrid\Model\ResourceModel\AdminGrid\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class MassDelete extends Action
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $deleteIds = $this->getRequest()->getPost('massaction'); //get value by key massaction from Post Request
        $collection = $this->collectionFactory->create(); // create collection Factory
        $collection->addFieldToFilter('id', ['in' => $deleteIds]); // add field from db to filter
        $delete = 0;// counter
        foreach ($collection as $item) {
            $item->delete(); // delete item
            $delete++; //counter increment
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $delete)); // add success mssage with counter
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT); // create Result Redirect
        return $resultRedirect->setPath('*/*/'); // set path
    }


}
