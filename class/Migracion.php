<?php 
namespace app\core;

/**
* Migracion
*/
class Migracion
{
	static private $connection;
	static private $tasks = [];
	static private $config;
	
	public static function init(){
		self::$connection = new Connection();

		self::$config = self::loadConfig();

		ConnectionLoader::load();

		self::$tasks = TaskLoader::load();
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