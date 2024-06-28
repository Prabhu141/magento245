<?php

namespace Practice\SampleModule\Cron;

use Practice\SampleModule\Model\ItemFactory;
use Practice\SampleModule\Model\Config;

class AddItem
{
	private $itemFactory;
	
	private $config;
	
	public function __construct(ItemFactory $itemFactory, Config $config)
	{		
		$this->itemFactory = $itemFactory;
		$this->config = $config;
	}
	
	public function execute()
	{
		if($this->config->isEnabled()){
			$this->itemFactory->create()
				 ->setName('Scheduled item')
				 ->setDescription('created at '. time())
				 ->save();
		}
	}
}
