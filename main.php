#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use app\core\Migracion;


Migracion::init();
print_r(Migracion::connection()->codero->connect());