<?php 
namespace Migration\Core;

/**
* PlanMigracion
*/
class PlanMigracion
{
	private $title;	
	private $items = [];	

	public function __construct(array $array)
	{
		if(isset($array['title'],$array['items'])){
			$this->title = $array['title'];

			foreach ($array['items'] as $key => $value)
			{
				$class = "\\Migration\\Handlers\\{$value['handler']}Handler";
				$params = [];

				if(isset($value['params']))
				{
					$params = $value['params'];
				}

				if(class_exists($class))
				{
					$object = new $class($params);
					$this->items[] = $object;
				}
				else{
					throw new \Exception("El Handler \"{$value['handler']}\" no se ha definido.", 4);
				}
			}
		}
		else{
			throw new \Exception("Plan de migración mal formado.", 3);
			
		}
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getItems()
	{
		return $this->items;
	}
}
 ?>