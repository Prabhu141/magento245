<?php
namespace Vendor\Module\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Image extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('vendor_module_image', 'image_id');
    }
}
