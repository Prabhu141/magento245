<?php
namespace YourVendor\ImageUpload\Block\Adminhtml\Image\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;

class Image extends AbstractRenderer
{
    protected $_storeManager;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function render(DataObject $row)
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $imagePath = $row->getData($this->getColumn()->getIndex());
        if ($imagePath) {
            return '<img src="' . $mediaUrl . $imagePath . '" width="75" height="75" />';
        }
        return '';
    }
}
