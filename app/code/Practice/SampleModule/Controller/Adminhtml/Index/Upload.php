<?php

namespace Practice\SampleModule\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Upload extends \Magento\Backend\App\Action
{
    public $fileUploader;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Practice\SampleModule\Model\FileUploader $fileUploader
    ) {
        parent::__construct($context);
        $this->fileUploader = $fileUploader;
    }

    public function execute()
    {
		
        try {
			
            $result = $this->fileUploader->saveFileToTmpDir('general[file]');
			
         } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
