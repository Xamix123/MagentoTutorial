<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Learning\CarTutorialOld\Setup;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Zend_Db_Exception;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Create table 'test_scripts_learning'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('my_cars'))
            ->addColumn(
                'car_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Car ID'
            )
            ->addColumn(
                'manufacturer',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'Manufacturer message'
            )
            ->addColumn(
                'model',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'Model message'
            )->setComment("Learning Message table");
        $setup->getConnection()->createTable($table);
    }
}
