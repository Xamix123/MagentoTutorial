<?php

namespace Learning\TestTask\Controller\Status;

use Learning\TestTask\Block\StatusForm;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\State\InputMismatchException;
use Magento\Framework\Profiler\Driver\Standard\Stat;

class Save extends Action
{
    const CUSTOM_CUSTOMER_ATTRIBUTE_CODE = "customer_status_attribute_custom";

    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @var Session
     */
    private $customerSession;

    /**
     * Save constructor.
     * @param Context $context
     * @param CustomerRepository $customerRepository
     */
    public function __construct(
        Context $context,
        CustomerRepository $customerRepository,
        Session $customerSession
    ) {

        $this->customerRepository  = $customerRepository;
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     * @throws InputMismatchException
     */
    public function execute()
    {

        $customerId = $this->customerSession->getCustomerId();
        $postObj = $this->getRequest()->getPostValue();

        $status = $postObj['status'] === null
            ? ""
            : $postObj['status'];

        $customerData = $this->customerRepository->getById($customerId);

        $customerData->setCustomAttribute(self::CUSTOM_CUSTOMER_ATTRIBUTE_CODE, $status);

        $this->customerRepository->save($customerData);

        $this->_redirect('customer/account/');
        return;
    }
}
