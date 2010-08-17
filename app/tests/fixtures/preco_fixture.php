<?php 
/* SVN FILE: $Id$ */
/* Preco Fixture generated on: 2010-08-13 08:37:30 : 1281699450*/

class PrecoFixture extends CakeTestFixture {
	var $name = 'Preco';
	var $table = 'precos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'created' => array('type'=>'datetime', 'null' => true),
		'expired' => array('type'=>'datetime', 'null' => true),
		'preco' => array('type'=>'float', 'null' => false),
		'produto_id' => array('type'=>'integer', 'null' => false),
		'ativo' => array('type'=>'boolean', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'created'  => '2010-08-13 08:37:30',
		'expired'  => '2010-08-13 08:37:30',
		'preco'  => '2010-08-13 08:37:30',
		'produto_id'  => 1,
		'ativo'  => 1
	));
}
?>