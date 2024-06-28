<?php

namespace Vendor\BrandSlider\Model;

use Magento\Framework\Model\AbstractModel;

class Brand extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Vendor\BrandSlider\Model\ResourceModel\Brand');
    }
}
