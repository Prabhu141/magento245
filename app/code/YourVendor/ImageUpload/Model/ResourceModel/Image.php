<?php
namespace YourVendor\ImageUpload\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Image extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('yourvendor_imageupload', 'image_id');
    }
}
