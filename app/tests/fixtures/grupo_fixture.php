<?php 
/* SVN FILE: $Id$ */
/* Grupo Fixture generated on: 2010-07-27 09:26:29 : 1280222789*/

class GrupoFixture extends CakeTestFixture {
	var $name = 'Grupo';
	var $table = 'grupos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'nome' => array('type'=>'string', 'null' => false, 'length' => 100),
		'ativo' => array('type'=>'boolean', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'nome'  => 'Lorem ipsum dolor sit amet',
		'ativo'  => 1
	));
}
?>