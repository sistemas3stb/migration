<?php 
namespace Migration\Core;

use SSHClient\ClientConfiguration\ClientConfiguration;
use SSHClient\ClientBuilder\ClientBuilder;

/**
* ServerSSH
*/
class ServerSSH extends Server
{
	protected $_options = [];
	protected $_username;
	protected $_privatekeyfile = '~/.ssh/id_rsa';
	protected $_cfg;
	protected $_type = "ssh";

	public function __construct($params)
	{
		parent::__construct($params);
	}

	public function connect()
	{
		$config = new ClientConfiguration($this->host, $this->username);
		$this->options = array_merge($this->options,[
			'Port'			=>$this->port,
			'IdentitiesOnly'=> 'yes',
			'IdentityFile'	=> $this->privatekeyfile
			]
		);
		$config->setOptions($this->options);

		$builder = new ClientBuilder($config);

		if($this->type=="ssh")
		{
			$this->session = $builder->buildClient();
		}
		else if($this->type=="scp")
		{
			$this->session = $builder->buildSecureCopyClient();
		}
		else{
			throw new \Exception("El tipo de conexión ssh \"{$this->type}\" no es valida.", 10);
			
		}
		$this->cfg = $config;
	}

	public function ping()
	{
		try {
			if(!$this->session) $this->connect();
			$output = $this->session->exec(['id'])->getOutput();
			echo $output;
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function getConfig()
	{
		return $this->cfg;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}

}

?>