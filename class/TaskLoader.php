<?php
namespace app\core;

/**
* TaskLoader
*/
class TaskLoader
{
	
	public static function load()
	{
		$files = scandir(Migracion::path('tasks/'));
		$taskfile = preg_grep('/^\d+_[A-Z]\w+.json$/', $files);
		print_r($taskfile);
		return $taskfile;
	}
}
?>