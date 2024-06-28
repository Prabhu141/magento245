<?php

namespace Vendor\BrandSlider\Model\ResourceModel\Brand;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Vendor\BrandSlider\Model\Brand', 'Vendor\BrandSlider\Model\ResourceModel\Brand');
    }
}
