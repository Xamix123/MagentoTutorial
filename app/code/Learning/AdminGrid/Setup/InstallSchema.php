<?php

namespace Learning\AdminGrid\Setup;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        /**
         * Create table 'testAdminHtml'
         */
        if (!$installer->tableExists('testAdminHtml')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('testAdminHtml')
            )->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'ID'
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable => false',
                ],
                'Name'
            )->addColumn(
                'title',
                Table::TYPE_TEXT,
                '255',
                [
                    'nullable => false',
                ],
                'AdminGrid Title'

            )->addColumn(
                'email',
                Table::TYPE_TEXT,
                '255',
                [
                    'nullable => false',
                ],
                'AdminGrid email'

            )->addColumn(
                'description',
                Table::TYPE_TEXT,
                '2M',
                [],
                'AdminGrid description'
            )->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'nullable' => false,
                ],
                'Status'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT,
                ],
                'Created At'
            )->setComment('AdminGrid Table');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
