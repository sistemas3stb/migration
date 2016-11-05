#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Migration\Core\Migracion;
use Migration\Core\CommandLineInteractive;

try{
	Migracion::init();
}
catch(Exception $e){
	echo CommandLineInteractive::printError("Exception: ".$e->getMessage()."\r\n");
}

