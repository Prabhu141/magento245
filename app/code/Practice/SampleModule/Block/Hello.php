<?php

namespace Practice\SampleModule\Block;

use Magento\Framework\View\Element\Template;
use Practice\SampleModule\Model\ResourceModel\Item\Collection;
use Practice\SampleModule\Model\ResourceModel\Item\CollectionFactory;

class Hello extends Template{
	
	private $collectionFactory;
	
	public function __construct(
		Template\Context $context,
		CollectionFactory $collectionFactory,
		array $data = []){
		
		$this->collectionFactory = $collectionFactory;
		parent::__construct($context, $data);
	}
	
	public function getItems()
	{
		return $this->collectionFactory->create()->getItems();
	}
}
