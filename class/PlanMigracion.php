<?php 
namespace app\core;

/**
* PlanMigracion
*/
class PlanMigracion
{
	private $title;	
	private $items = [];	

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function addItem($object)
	{
		$this->items[] = $object;
	}

	public function setItems($items)
	{
		$this->items = $items;
	}

	public function getItems()
	{
		return $this->items;
	}
}
 ?>