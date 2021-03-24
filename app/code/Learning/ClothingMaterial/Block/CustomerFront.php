<?php

namespace Learning\ClothingMaterial\Block;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\View\Element\Template;

class CustomerFront extends FrontendModelShow
{
    const NAME_ATTRIBUTE = "test_customer_attribute";
    const TITLE = "Customer";

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * CustomerFront constructor.
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Customer $customer,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->customer = $customer;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getAdditionalData() :array
    {
        $data = [];
        $collection = $this->collectionFactory->create();

        return parent::getAdditionalDataFromCollection($collection, $this->customer);
    }

    /**
     * @param $entity
     * @return string
     */
    public function getName($entity): string
    {
        return $entity['firstname'] . " " . $entity['middlename'] . " " . $entity['lastname'];
    }
}
