<?php

namespace Vendor\Module\Model\ResourceModel\Image;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Vendor\Module\Model\Image', 'Vendor\Module\Model\ResourceModel\Image');
    }
}
