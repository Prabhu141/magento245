<?php
namespace YourVendor\ImageUpload\Block\Adminhtml\Image;

use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use YourVendor\ImageUpload\Model\ResourceModel\Image\CollectionFactory;

class Grid extends Extended
{
    protected $collectionFactory;

    public function __construct(
        Context $context,
        Data $backendHelper,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $backendHelper, $data);
        $this->setId('imageGrid');
        $this->setDefaultSort('image_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = $this->collectionFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'image_id',
            [
                'header' => __('ID'),
                'index' => 'image_id',
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
            ]
        );

        $this->addColumn(
            'image',
            [
                'header' => __('Image'),
                'index' => 'image',
                'renderer' => 'YourVendor\ImageUpload\Block\Adminhtml\Image\Renderer\Image',
            ]
        );

        $this->addColumn(
            'created_at',
            [
                'header' => __('Created At'),
                'index' => 'created_at',
                'type' => 'datetime',
            ]
        );

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }
}
