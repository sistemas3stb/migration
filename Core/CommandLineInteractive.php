<?php 
namespace Migration\Core;

/**
* CommandLineInteractive
*/
class CommandLineInteractive
{
	CONST COLOR_NC="\e[0m";
	CONST COLOR_WHITE="\e[1;37m";
	CONST COLOR_BLACK="\e[0;30m";
	CONST COLOR_BLUE="\e[0;34m";
	CONST COLOR_LIGHT_BLUE="\e[1;34m";
	CONST COLOR_GREEN="\e[0;32m";
	CONST COLOR_LIGHT_GREEN="\e[1;32m";
	CONST COLOR_CYAN="\e[0;36m";
	CONST COLOR_LIGHT_CYAN="\e[1;36m";
	CONST COLOR_RED="\e[0;31m";
	CONST COLOR_LIGHT_RED="\e[1;31m";
	CONST COLOR_PURPLE="\e[0;35m";
	CONST COLOR_LIGHT_PURPLE="\e[1;35m";
	CONST COLOR_BROWN="\e[0;33m";
	CONST COLOR_YELLOW="\e[1;33m";
	CONST COLOR_GRAY="\e[0;30m";
	CONST COLOR_LIGHT_GRAY="\e[0;37m";

	private $plans;

	public function __construct(array $plans)
	{
		$this->plans = $plans;
		$this->banner();
		$this->menu();
	}

	public function line($char="=")
	{
		for ($i=0; $i < Migracion::$term_cols; $i++) { 
			echo $char;
		}
		echo "\r\n";
	}
	public function banner()
	{
		$this->line();
		echo "Migration\r\n";
		$this->line();
	}

	public function menu()
	{
		if(count($this->plans)>0){
			self::printItem("Seleccione el plan de migración a ejecutar:\r\n");

			foreach ($this->plans as $key => $value) {
				$index = str_pad($key+1,3,' ',STR_PAD_LEFT);
				echo self::printItem("$index) {$value->getTitle()}\r\n");
				
				foreach ($value->getItems() as $k => $v) {
					if($v->isParamExists("comment"))
					{						
						$output = sprintf("     => %s",$v->getParam("comment"));
						if(strlen($output)>Migracion::$term_cols)
						{
							$output = substr($output, 0,Migracion::$term_cols-3)."...";
						}
						
						echo "$output\r\n";
						
					}
				}
				echo "\r\n";
			}

			self::printItem("  t) Ejecutar todos los planes de migración\r\n");
			self::printItem("  s) Salir\r\n");


			echo "#? [t]: ";
			$data = readline();

			if(empty($data))
			{
				$this->runAll();
			}
			else if($data == "s")
			{
				exit();
			}
			else if(($val=intval($data))>0 && intval($data)<=count($this->plans)){
				$this->runPlan($val-1);
			}
			else{
				echo "Opción no valida\r\n";
			}
		}
		else{
			echo "No hay plan de migración disponibles\r\n";
		}
	}

	public static function printItem($string)
	{
		echo self::COLOR_YELLOW.$string.self::COLOR_NC;
	}

	public static function printError($string)
	{
		echo self::COLOR_LIGHT_RED.$string.self::COLOR_NC;
	}

	public function runAll()
	{
		foreach ($this->plans as $key => $value) {
			$this->runPlan($key);	
		}
	}

	public function runPlan($index)
	{
		$plan = $this->plans[$index];
		$this->line("*");
		echo "PLAN: ".$plan->getTitle()."\r\n";
		$this->line("*");
		foreach ($plan->getItems() as $key => $value) {
			$value->run();
		}
		
	}
}?>