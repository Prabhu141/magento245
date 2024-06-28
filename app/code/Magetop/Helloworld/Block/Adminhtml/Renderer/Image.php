<?php
namespace Magetop\Helloworld\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;

class Image extends AbstractRenderer
{
    protected $storeManager;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->storeManager = $storeManager;
    }

    public function render(DataObject $row)
    {
        $image = $this->_getValue($row);
        if ($image) {
            $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            $url = $mediaUrl . '/helloworld/images/' . $image;
            $html = '<img src="' . $url . '" width="100" height="100"/>';
            return $html;
        }
        return '';
    }
}
