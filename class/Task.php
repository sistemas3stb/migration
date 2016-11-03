<?php 
namespace app\core;

/**
 * ITask
 */
 interface ITask
 {
 	function preRun();
 	function run();
 	function postRun();
 }

/**
* Task
*/
class Task implements ITask
{
	private $params;

	public function __construct($params)
	{
		$this->params = $params;

		if($this->preRun()){
			$this->run();
			$this->postRun();
		}
	}

	public function preRun()
	{
		// Code preRun
		return true;
	}

	public function run()
	{
		// Code run
	}

	public function postRun()
	{
		// Code postRun
	}
}
?>