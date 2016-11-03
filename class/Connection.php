<?php 
namespace app\core;

/**
* Connection
*/
class Connection
{
	private $connections = [];

	public function add($name,$params)
	{
		$protocol = $params['protocol'];
		$class = "\\app\\core\\Server{$params['protocol']}";

		if(class_exists($class))
		{

			unset($params['protocol']);
			$object = new $class($params);
			$this->connections[$name] = $object;
		}
		else{
			throw new \Exception("El protocolo no es soportado", 1);
		}
	}	

	public function __get($name)
	{
		if(isset($this->connections[$name]))
		{
			return $this->connections[$name];
		}
	}
}
?>