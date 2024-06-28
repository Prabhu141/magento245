<?php

namespace Vendor\BrandSlider\Controller\Adminhtml\Brand;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Vendor\BrandSlider\Model\BrandFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Save extends Action
{
    protected $brandFactory;
    protected $resultRedirectFactory;

    public function __construct(Context $context, BrandFactory $brandFactory, RedirectFactory $resultRedirectFactory)
    {
        parent::__construct($context);
        $this->brandFactory = $brandFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $brand = $this->brandFactory->create();
            if (isset($data['brand_id'])) {
                $brand->load($data['brand_id']);
            }
            $brand->setData($data);
            try {
                $brand->save();
                $this->messageManager->addSuccessMessage(__('The brand has been saved.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
