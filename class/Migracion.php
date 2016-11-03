<?php 
namespace app\core;

/**
* Migracion
*/
class Migracion
{
	static private $connection;
	static private $config;
	
	static public function init(){
		self::$connection = new Connection();

		self::$config = self::loadConfig();

		if(isset(self::$config['servers'])){
			foreach (self::$config['servers'] as $key => $value) {
				self::connection()->add($key,$value);
			}
		}
	}

	private function loadConfig()
	{
		return require 'config.php';
	}

	static public function connection()
	{
		return self::$connection;
	}

}
?>