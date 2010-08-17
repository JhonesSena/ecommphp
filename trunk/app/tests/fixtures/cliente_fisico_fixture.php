<?php 
/* SVN FILE: $Id$ */
/* ClienteFisico Fixture generated on: 2010-07-27 09:30:37 : 1280223037*/

class ClienteFisicoFixture extends CakeTestFixture {
	var $name = 'ClienteFisico';
	var $table = 'cliente_fisicos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'cliente_id' => array('type'=>'integer', 'null' => false),
		'nome' => array('type'=>'string', 'null' => false, 'length' => 50),
		'cpf' => array('type'=>'string', 'null' => false, 'length' => 15),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'cliente_id'  => 1,
		'nome'  => 'Lorem ipsum dolor sit amet',
		'cpf'  => 'Lorem ipsum d'
	));
}
?>