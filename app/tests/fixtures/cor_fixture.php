<?php 
/* SVN FILE: $Id$ */
/* Cor Fixture generated on: 2010-07-27 09:25:45 : 1280222745*/

class CorFixture extends CakeTestFixture {
	var $name = 'Cor';
	var $table = 'cores';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'nome' => array('type'=>'string', 'null' => false, 'length' => 100),
		'red' => array('type'=>'integer', 'null' => false),
		'gren' => array('type'=>'integer', 'null' => false),
		'blue' => array('type'=>'integer', 'null' => false),
		'ativo' => array('type'=>'boolean', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'nome'  => 'Lorem ipsum dolor sit amet',
		'red'  => 1,
		'gren'  => 1,
		'blue'  => 1,
		'ativo'  => 1
	));
}
?>