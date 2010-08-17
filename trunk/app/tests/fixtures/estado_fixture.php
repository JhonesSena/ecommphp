<?php 
/* SVN FILE: $Id$ */
/* Estado Fixture generated on: 2010-07-27 09:22:49 : 1280222569*/

class EstadoFixture extends CakeTestFixture {
	var $name = 'Estado';
	var $table = 'estados';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'nome' => array('type'=>'string', 'null' => false, 'length' => 100),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'nome'  => 'Lorem ipsum dolor sit amet'
	));
}
?>