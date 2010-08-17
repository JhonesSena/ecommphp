<?php 
/* SVN FILE: $Id$ */
/* Cedente Fixture generated on: 2010-07-27 09:31:51 : 1280223111*/

class CedenteFixture extends CakeTestFixture {
	var $name = 'Cedente';
	var $table = 'cedentes';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'conta_corrente' => array('type'=>'string', 'null' => false, 'length' => 10),
		'cliente_id' => array('type'=>'integer', 'null' => false),
		'agencia_id' => array('type'=>'integer', 'null' => false),
		'bloqueto_id' => array('type'=>'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'conta_corrente'  => 'Lorem ip',
		'cliente_id'  => 1,
		'agencia_id'  => 1,
		'bloqueto_id'  => 1
	));
}
?>