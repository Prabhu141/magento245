<?php

namespace Practice\SampleModule\Model;

use Practice\SampleModule\Api\ItemRepositoryInterface;
use Practice\SampleModule\Model\ResourceModel\Item\CollectionFactory;

class ItemRepository implements ItemRepositoryInterface
{
	private $collectionFactory;
	
	public function __construct(CollectionFactory $collectionFactory)
	{
		$this->collectionFactory = $collectionFactory;
	}
	
	public function getList()
	{
		return $this->collectionFactory->create()->getItems();
	}
}