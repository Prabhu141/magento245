<?php 

namespace Practice\SampleModule\Model;

use Magento\Framework\Model\AbstractModel;

class Item extends AbstractModel{
	
	protected $_eventPrefix = 'practice_sample_item';
	
	protected function _construct()
	{
		$this->_init(\Practice\SampleModule\Model\ResourceModel\Item::class);
	}
}
