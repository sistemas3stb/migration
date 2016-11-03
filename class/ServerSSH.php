<?php 
namespace app\core;

/**
* ServerSSH
*/
class ServerSSH extends Server
{
	CONST AUTH_NONE 	= 0x0F;
	CONST AUTH_PASSWORD = 0x1F;
	CONST AUTH_PUBKEY 	= 0x2F;
	
	protected $_method = ['hostkey'=>'ssh-rsa'];
	protected $_username;
	protected $_typeauth ;
	protected $_password;
	protected $_pubkeyfile;
	protected $_privatekeyfile;

	public function __construct($params)
	{
		parent::__construct($params);
	}

	public function connect()
	{
		$this->session = ssh2_connect($this->host,$this->port,$this->method);

		if($this->session)
		{
			echo "Conectado a {$this->host}:{$this->port}\r\n";
		}
		else{
			echo "[!] Error al conectar a {$this->host}:{$this->port}\r\n";
		}
	}	
}

?>