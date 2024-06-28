<?php
namespace YourVendor\ImageUpload\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Image extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_image';
        $this->_blockGroup = 'YourVendor_ImageUpload';
        $this->_headerText = __('Images');
        $this->_addButtonLabel = __('Add New Image');
        parent::_construct();
    }

    protected function _prepareLayout()
    {
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('YourVendor\ImageUpload\Block\Adminhtml\Image\Grid', $this->_controller . '.grid')
        );
        return parent::_prepareLayout();
    }
}
