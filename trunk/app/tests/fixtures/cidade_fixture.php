<?php 
/* SVN FILE: $Id$ */
/* Cidade Fixture generated on: 2010-07-27 09:23:25 : 1280222605*/

class CidadeFixture extends CakeTestFixture {
	var $name = 'Cidade';
	var $table = 'cidades';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'estado_id' => array('type'=>'integer', 'null' => false),
		'nome' => array('type'=>'string', 'null' => false, 'length' => 100),
		'ativo' => array('type'=>'boolean', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'estado_id'  => 1,
		'nome'  => 'Lorem ipsum dolor sit amet',
		'ativo'  => 1
	));
}
?>