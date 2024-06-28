<?php
namespace YourVendor\ImageUpload\Model;

use Magento\Framework\Model\AbstractModel;

class Image extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('YourVendor\ImageUpload\Model\ResourceModel\Image');
    }
}
