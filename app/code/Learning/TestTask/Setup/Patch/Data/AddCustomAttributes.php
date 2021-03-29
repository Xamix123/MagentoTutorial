<?php

namespace Learning\TestTask\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;

class AddCustomAttributes implements DataPatchInterface, PatchVersionInterface
{
    const CUSTOM_CUSTOMER_ATTRIBUTE_CODE = "customer_status_attribute_custom";

    protected $moduleDataSetup;

    private $eavConfig;

    private $eavSetupFactory;

    /**
     * Init
     * @param EavSetupFactory $eavSetupFactory
     * @param Config $eavConfig
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute(
            Customer::ENTITY,
            self::CUSTOM_CUSTOMER_ATTRIBUTE_CODE,
            [
                'label' => 'Customer Status Custom',
                'default' => "",
                'input' => 'text',
                'visible' => true,
                'required' => false,
                'position' => 155,
                'sort_order' => 155,
                'system' => false
            ]
        );

        $customerAttribute = $this->eavConfig->getAttribute(
            Customer::ENTITY,
            self::CUSTOM_CUSTOMER_ATTRIBUTE_CODE
        );

        $customerAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer']
        );

        $customerAttribute->save();
        $this->moduleDataSetup->endSetup();

    }

    public static function getDependencies()
    {
        return [];
    }

    public static function getVersion()
    {
        return '1.0.1';
    }

    public function getAliases()
    {
        return [];
    }
}
