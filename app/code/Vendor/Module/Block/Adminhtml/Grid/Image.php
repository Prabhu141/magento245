<?php
namespace Vendor\Module\Block\Adminhtml\Grid;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;

class Image extends Template
{
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}
