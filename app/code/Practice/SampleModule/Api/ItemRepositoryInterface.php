<?php

namespace Practice\SampleModule\Api;

interface ItemRepositoryInterface
{
	/**
	* @return \Practice\SampleModule\Api\Data\ItemInterface[]
	*/
	public function getList();
}