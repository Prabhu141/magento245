<?php

namespace Vendor\BrandSlider\Block;

use Magento\Framework\View\Element\Template;
use Vendor\BrandSlider\Model\ResourceModel\Brand\CollectionFactory;

class BrandSlider extends Template
{
    protected $collectionFactory;

    public function __construct(Template\Context $context, CollectionFactory $collectionFactory, array $data = [])
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    public function getBrandCollection()
    {
        $collection = $this->collectionFactory->create();
        return $collection->getItems();
    }
}
