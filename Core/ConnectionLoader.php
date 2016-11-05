<?php 
namespace Migration\Core;

/**
* ConnectionLoader
*/
class ConnectionLoader
{
	public static function load()
	{
		if($servers = Migracion::config('servers'))
		{
			foreach ($servers as $key => $value)
			{
				Migracion::connection()->add($key,$value);
			}
		}
	}
}
?>