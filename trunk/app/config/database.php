<?php
class DATABASE_CONFIG {

	var $default = array(
		'driver' => 'postgres',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'usr_ecomm',
		'password' => 'usr_ecomm',
		'database' => 'ecomm',
	);
	var $producao = array(
		'driver' => 'postgres',
		'persistent' => false,
		'host' => 'postgresql01.bocazul.com.br',
		'login' => 'bocazul11',
		'password' => 'reb36411',
		'database' => 'bocazul11',
	);
}
?>