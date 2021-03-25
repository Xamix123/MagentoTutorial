<?php

namespace Learning\ClothingMaterial\Block;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
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
     * @var CustomerRepository
     */
    private $customerRepository;

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
        CustomerRepository $customerRepository,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->customer = $customer;
        $this->customerRepository = $customerRepository;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getAdditionalData() :array
    {
        $data = [];
        $customData = [];
        $value = "";
        $collection = $this->collectionFactory->create();
        $collectionData = $collection->getData();
        foreach ($collectionData as $id => $item) {
            $entity = $this->customerRepository->get($item['email'], $item['website_id']);

            $attribute = $entity->getCustomAttribute(self::NAME_ATTRIBUTE);
            $value = $attribute !== null
                ? $attribute->getValue()
                : "";

            $this->customer->setData(
                self::NAME_ATTRIBUTE,
                $value
            );

            $customData[$id]['name'] = self::getName($entity);
            $customData[$id]['email'] = $item['email'];
            $customData[$id]['value'] = $collection->getAttribute(static::NAME_ATTRIBUTE)->getFrontend()
                ->getValue($this->customer);
        }
        return parent::getAdditionalDataFromCollection($collection, $customData);
    }

    /**
     * @param $entity
     * @return string
     */
    public function getName($entity): string
    {
        return $entity->getFirstName() . " " . $entity->getMiddleName() . " " . $entity->getLastName();
    }
}
