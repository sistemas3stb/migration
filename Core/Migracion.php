<?php 
namespace Migration\Core;

/**
* Migracion
*/
class Migracion
{
	static private $connection;
	static private $plans = [];
	static private $config;
	static public  $term_cols;
	
	public static function init(){
		self::$term_cols = `tput cols`;

		self::$connection = new Connection();

		self::$config = self::loadConfig();

		ConnectionLoader::load();

		self::$plans = PlanLoader::load();

		new CommandLineInteractive(self::$plans);
	}

	public function getPlans()
	{
		return $this->plans;
	}

	private function loadConfig()
	{
		return require 'config.php';
	}

	public static function connection()
	{
		return self::$connection;
	}

	public static function rootPath()
	{
		return dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
	}

	public static function path($path)
	{
		return self::rootPath() . $path;
	}

	public static function config($key)
	{
		if(isset(self::$config[$key])){
			return self::$config[$key];
		}

		return false;
	}

}
?>