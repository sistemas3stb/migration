<?php 
namespace app\core;

/**
* Server
*/
abstract class Server
{
	protected $_session;
	protected $_host;
	protected $_port;

	public function __construct($params)
	{
		$this->setPropertyFromArray($params);
	}

	public function __set($name,$value)
	{
		$property = "_$name";
		if(property_exists(get_called_class(), $property))
		{
			$this->{$property} = $value;
		}
	}

	private function setPropertyFromArray($array)
	{
		foreach ($array as $key => $value)
		{
			$this->{$key} = $value;	
		}
	}

	abstract public function connect();

	public function getSession()
	{
		return $this->session;
	}

	public function __get($name)
	{
		$property = "_$name";
		if(property_exists(get_called_class(), $property))
		{
			return $this->{$property};
		}
		
		return null;
	}
}
?>