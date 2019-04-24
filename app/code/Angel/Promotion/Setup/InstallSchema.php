<?php


namespace Angel\Promotion\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table_angel_promotion_free = $setup->getConnection()->newTable($setup->getTable('angel_promotion_free'));

        $table_angel_promotion_free->addColumn(
            'free_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_angel_promotion_free->addColumn(
            'buy',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Purchase X'
        );

        $table_angel_promotion_free->addColumn(
            'free',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Get Y'
        );

        $table_angel_promotion_free->addColumn(
            'sort_order',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Sort Order'
        );

        $table_angel_promotion_free->addColumn(
            'total_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Total Time used promotion'
        );

        $table_angel_promotion_free->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [],
            'Status'
        );

        //Your install script

        $setup->getConnection()->createTable($table_angel_promotion_free);
    }
}
