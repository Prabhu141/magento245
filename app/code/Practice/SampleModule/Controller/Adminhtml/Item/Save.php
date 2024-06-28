<?php

namespace Practice\SampleModule\Controller\Adminhtml\Item;

use Practice\SampleModule\Model\ItemFactory;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    private $itemFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ItemFactory $itemFactory
    ) {
        $this->itemFactory = $itemFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
    
        $postData = $this->getRequest()->getPostValue();
        if (!isset($postData['general'])) {
            $this->messageManager->addErrorMessage(__('No data found.'));
            return $resultRedirect->setPath('*/*/');
        }
    
        $data = $postData['general'];
    
        // Process the 'file' field if it exists
        if (isset($data['file']) && is_array($data['file'])) {
            // Assuming you only care about the first file in the array
            $fileData = $data['file'][0];
            // Save only the file URL
            $data['file'] = $fileData['url'];
        }
    
        $itemId = isset($data['entity_id']) ? (int)$data['entity_id'] : null;
    
        try {
            $model = $this->itemFactory->create();
            if ($itemId) {
                $model->load($itemId);
            }
            $model->setData($data);
            $model->save();
    
            $this->messageManager->addSuccessMessage(__('Item saved successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error occurred while saving item: %1', $e->getMessage()));
        }
    
        return $resultRedirect->setPath('practice/index/index');
    }
    
    
}
