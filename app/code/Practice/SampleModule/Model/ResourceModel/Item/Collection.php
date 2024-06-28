<?php 

namespace Practice\SampleModule\Model\ResourceModel\Item;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Practice\SampleModule\Model\Item;
use Practice\SampleModule\Model\ResourceModel\Item as ItemResource;

class Collection extends AbstractCollection{
	
	protected $_eventPrefix = 'practice_sample_item';
	
	protected function _construct()
	{
		$this->_init(Item::class, ItemResource::class);
	}
}
