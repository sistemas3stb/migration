<?php 
namespace Migration\Handlers;

use Migration\Core\Task;
use Migration\Core\Migracion;

/**
* SCPHanlder
*/
class ScpHandler extends Task
{
	public function run()
	{
		if(!$this->isParamExists("server"))
			throw new \Exception("El parametro \"server\" es requerido.", 5);

		if(!$this->isParamExists("source"))
			throw new \Exception("El parametro \"source\" es requerido.", 6);

		if(!is_array($this->getParam("source")))
			throw new \Exception("El parametro \"source\" debe ser de tipo array.", 7);
		
		if(!$this->isParamExists("destination"))
			throw new \Exception("El parametro \"destination\" es requerido.", 8);

		$connection = Migracion::connection()->{$this->getParam("server")};
		
		if(!$connection)
		{
			throw new \Exception("El parametro \"server\" no es una conexión valida.", 9);
		}
		else{
			$connection->setType('ssh');
			$connection->connect();
			$connection->getConfig()->setSCPOptions(array('r'));

			$session = $connection->session;

			foreach ($this->getParam("source") as $key => $value) {
				$output = $session->copy($session->getRemotePath($value),$this->getParam("destination"))->getOutput();

			}
			

		}

	}
}
?>