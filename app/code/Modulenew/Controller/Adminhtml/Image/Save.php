<?php

namespace Vendor\Module\Controller\Adminhtml\Image;

use Magento\Backend\App\Action;
use Vendor\Module\Model\ImageFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends Action
{
    protected $imageFactory;
    protected $dataPersistor;

    public function __construct(
        Action\Context $context,
        ImageFactory $imageFactory,
        DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context);
        $this->imageFactory = $imageFactory;
        $this->dataPersistor = $dataPersistor;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $model = $this->imageFactory->create();

        if (isset($data['image_id'])) {
            $model->load($data['image_id']);
        }

        $model->setData($data);

        try {
            $model->save();
            $this->messageManager->addSuccessMessage(__('You saved the image.'));
            $this->dataPersistor->clear('vendor_module_image');
            return $this->_redirect('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $this->dataPersistor->set('vendor_module_image', $data);
        return $this->_redirect('*/*/edit', ['image_id' => $model->getId()]);
    }
}
