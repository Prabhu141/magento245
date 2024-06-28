<?php
namespace YourVendor\ImageUpload\Controller\Adminhtml\Image;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use YourVendor\ImageUpload\Model\ImageFactory;

class NewAction extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $registry;
    protected $imageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        ImageFactory $imageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->imageFactory = $imageFactory;
    }

    public function execute()
    {
        $model = $this->imageFactory->create();
        $this->registry->register('imageupload_image', $model);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('New Image'));

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('YourVendor_ImageUpload::manage');
    }
}
