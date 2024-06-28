<?php
namespace YourVendor\ImageUpload\Controller\Adminhtml\Image;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use YourVendor\ImageUpload\Model\ImageFactory;

class Delete extends \Magento\Backend\App\Action
{
    protected $imageFactory;

    public function __construct(
        Context $context,
        ImageFactory $imageFactory
    ) {
        parent::__construct($context);
        $this->imageFactory = $imageFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->imageFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The image has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find an image to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
