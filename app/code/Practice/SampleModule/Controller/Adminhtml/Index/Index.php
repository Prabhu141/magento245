<?php

namespace Practice\SampleModule\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Backend\App\Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
	
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Practice_SampleModule::practice');
	}
}
