<?php 
namespace app\core;

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
		$this->session = $builder->buildClient();
	}
}

?>