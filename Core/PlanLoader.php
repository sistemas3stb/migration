<?php
namespace Migration\Core;

/**
* PlanLoader
*/
class PlanLoader
{
	
	public static function load()
	{
		$plans = [];

		$files = scandir(Migracion::path('Plan/'));
		$planfile = preg_grep('/^\d+_[A-Z]\w+.json$/', $files);

		foreach ($planfile as $key => $value) {
			$json = file_get_contents(Migracion::path('Plan/'.$value));
			$array = json_decode($json,true);			
			$plans[] = new PlanMigracion($array);
		}

		return $plans;
	}
}
?>