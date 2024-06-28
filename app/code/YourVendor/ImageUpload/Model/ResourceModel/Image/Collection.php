<?php
namespace YourVendor\ImageUpload\Model\ResourceModel\Image;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'image_id';
    protected $_eventPrefix = 'yourvendor_imageupload_collection';
    protected $_eventObject = 'image_collection';

    protected function _construct()
    {
        $this->_init('YourVendor\ImageUpload\Model\Image', 'YourVendor\ImageUpload\Model\ResourceModel\Image');
    }
}
