<?php 
namespace Migration\Core;

/**
 * ITask
 */
 interface ITask
 {
 	function run();
 }

/**
* Task
*/
class Task implements ITask
{
	private $params;

	public function __construct(array $params)
	{
		$this->params = $params;
	}

	public function run()
	{
		// Code run
	}

	public function getParam($name)
	{
		if(isset($this->params[$name]))
		{
			return $this->params[$name];
		}

		return null;
	}

	public function isParamExists($name)
	{
		if(isset($this->params[$name]))
		{
			return true;
		}
		else{
			return false;
		}
	}
}
?>