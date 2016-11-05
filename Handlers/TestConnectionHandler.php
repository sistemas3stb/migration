<?php
namespace Migration\Handlers;

use Migration\Core\Task;
use Migration\Core\Migracion;

/**
* TestConnection
*/
class TestConnectionHandler extends Task
{
	
	public function run()
	{
		$connections = Migracion::connection()->getAll();
		foreach ($connections as $key => $value) {
			echo "Test Server [$key]: {$value->host}:{$value->port}";				
			if($value->ping()){
				echo "[OK]";
			}
			else{
				echo "[ERROR]";
			}
			echo "\r\n";
		}
	}
}
?>