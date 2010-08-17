<?php 
/* SVN FILE: $Id$ */
/* Bloqueto Fixture generated on: 2010-07-27 09:14:33 : 1280222073*/

class BloquetoFixture extends CakeTestFixture {
	var $name = 'Bloqueto';
	var $table = 'bloquetos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'banco_id' => array('type'=>'integer', 'null' => false),
		'local_pagamento' => array('type'=>'string', 'null' => false, 'length' => 150),
		'carteira' => array('type'=>'string', 'null' => false, 'length' => 10),
		'tipo' => array('type'=>'string', 'null' => false, 'length' => 70),
		'ativo' => array('type'=>'boolean', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'banco_id'  => 1,
		'local_pagamento'  => 'Lorem ipsum dolor sit amet',
		'carteira'  => 'Lorem ip',
		'tipo'  => 'Lorem ipsum dolor sit amet',
		'ativo'  => 1
	));
}
?>