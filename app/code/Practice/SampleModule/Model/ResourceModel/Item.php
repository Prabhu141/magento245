<?php

namespace Practice\SampleModule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Item extends AbstractDb{
	
	protected function _construct(){
		$this->_init('practice_sample_item', 'entity_id');
	}
}
