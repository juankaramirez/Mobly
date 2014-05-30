<?php

class categoryTest extends WebTestCase
{
	public $fixtures=array(
		'categories'=>'category',
	);

	public function testShow()
	{
		$this->open('?r=category/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=category/create');
	}

	public function testUpdate()
	{
		$this->open('?r=category/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=category/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=category/index');
	}

	public function testAdmin()
	{
		$this->open('?r=category/admin');
	}
}
