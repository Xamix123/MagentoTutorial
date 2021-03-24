<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Learning\ClothingMaterial\Setup\Patch\Data;

use Learning\ClothingMaterial\Model\Attribute\Source\CmsBlock;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Product;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;

class AddCustomAttributes implements DataPatchInterface, PatchVersionInterface
{
    const CUSTOM_PRODUCT_ATTRIBUTE_CODE = 'clothing_material';
    const CUSTOM_CATEGORY_ATTRIBUTE_CODE = 'test_category_attribute';
    const CUSTOM_CATEGORY_UI_ATTRIBUTE_CODE = 'test_customer_ui_attribute';
    const CUSTOM_CUSTOMER_ATTRIBUTE_CODE = 'test_customer_attribute';

    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    private $eavConfig;

    /**
     * Eav setup factory
     * @var EavSetupFactory
     */
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
            Product::ENTITY,
            self::CUSTOM_PRODUCT_ATTRIBUTE_CODE,
            [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Clothing Material',
                'input' => 'select',
                'source' => 'Learning\ClothingMaterial\Model\Attribute\Source\Material',
                'frontend' => 'Learning\ClothingMaterial\Model\Attribute\Frontend\Material',
                'backend' => 'Learning\ClothingMaterial\Model\Attribute\Backend\Material',
                'required' => false,
                'sort_order' => 50,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );

        $eavSetup->addAttribute(
            Product::ENTITY,
            CmsBlock::CMS_BLOCK_ATTRIBUTE,
            [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'CMS blocks',
                'input' => 'select',
                'source' => 'Learning\ClothingMaterial\Model\Attribute\Source\CmsBlock',
                'frontend' => 'Learning\ClothingMaterial\Model\Attribute\Frontend\CmsBlock',
                'backend' => '',
                'required' => false,
                'sort_order' => 51,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );

        $eavSetup->addAttribute(
            Category::ENTITY,
            self::CUSTOM_CATEGORY_ATTRIBUTE_CODE,
            [
                'type' => 'varchar',
                'label' => 'test category attribute',
                'input' => 'text',
                'visible' => true,
                'required' => false,
                'sort_order' => 100,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'group' => 'General Information'
            ]
        );

        /* ui component eav attribute for category */

        $eavSetup->addAttribute(
            Category::ENTITY,
            self::CUSTOM_CATEGORY_UI_ATTRIBUTE_CODE,
            [
                'type' => 'int',
                'label' => 'Ui Component test category attribute',
                'input' => 'boolean',
                'source'   => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'frontend' => 'Learning\ClothingMaterial\Model\Attribute\Frontend\Category',
                'visible' => true,
                'default' => '0',
                'required' => false,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'group' => 'Display Settings'
            ]
        );

        $eavSetup->addAttribute(
            Customer::ENTITY,
            self::CUSTOM_CUSTOMER_ATTRIBUTE_CODE,
            [
                'label' => 'Customer attribute',
                'frontend' => 'Learning\ClothingMaterial\Model\Attribute\Frontend\Customer',
                'default' => "",
                'input' => 'text',
                'visible' => true,
                'required' => false,
                'position' => 150,
                'sort_order' => 150,
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
