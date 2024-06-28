<?php
namespace YourVendor\ImageUpload\Block\Frontend;

use Magento\Framework\View\Element\Template;
use YourVendor\ImageUpload\Model\ResourceModel\Image\CollectionFactory;

class ImageList extends Template
{
    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getImages()
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect('*');
        return $collection;
    }

    public function getMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
