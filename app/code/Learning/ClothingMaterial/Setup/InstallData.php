<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Learning\ClothingMaterial\Setup;

use Exception;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Product;
use Magento\Cms\Model\Block;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    const CUSTOM_PRODUCT_ATTRIBUTE_CODE = 'clothing_material';
    const CUSTOM_CATEGORY_ATTRIBUTE_CODE = 'test_category_attribute';
    const CMS_BLOCK_ATTRIBUTE = 'testCmsBlock';
    const CUSTOM_CATEGORY_UI_ATTRIBUTE_CODE = 'test_customer_ui_attribute';
    const CUSTOM_CUSTOMER_ATTRIBUTE_CODE = 'test_customer_attribute';

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
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @throws Exception
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
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
            self::CMS_BLOCK_ATTRIBUTE,
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
    }
}
