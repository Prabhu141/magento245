<?php

namespace Vendor\BrandSlider\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable($setup->getTable('brand_slider'))
            ->addColumn(
                'brand_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Brand ID'
            )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Brand Name'
            )
            ->addColumn(
                'image',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Brand Image'
            )
            ->setComment('Brand Slider Table');

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
