<?php
namespace YourVendor\ImageUpload\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('yourvendor_imageupload')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('yourvendor_imageupload')
            )
            ->addColumn(
                'image_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Image ID'
            )
            ->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Image Title'
            )
            ->addColumn(
                'image',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Image Path'
            )
            ->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'Created At'
            )
            ->setComment('Image Upload Table');

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
