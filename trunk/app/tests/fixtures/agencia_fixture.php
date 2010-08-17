<?php 
/* SVN FILE: $Id$ */
/* Agencia Fixture generated on: 2010-07-27 09:25:08 : 1280222708*/

class AgenciaFixture extends CakeTestFixture {
	var $name = 'Agencia';
	var $table = 'agencias';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'codigo' => array('type'=>'string', 'null' => false, 'length' => 10),
		'codigo_cedente' => array('type'=>'string', 'null' => false, 'length' => 50),
		'logradouro' => array('type'=>'string', 'null' => true, 'length' => 300),
		'bairro' => array('type'=>'string', 'null' => true, 'length' => 50),
		'cidade_id' => array('type'=>'integer', 'null' => true),
		'telefone' => array('type'=>'string', 'null' => true, 'length' => 17),
		'banco_id' => array('type'=>'integer', 'null' => false),
		'ativo' => array('type'=>'boolean', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'codigo'  => 'Lorem ip',
		'codigo_cedente'  => 'Lorem ipsum dolor sit amet',
		'logradouro'  => 'Lorem ipsum dolor sit amet',
		'bairro'  => 'Lorem ipsum dolor sit amet',
		'cidade_id'  => 1,
		'telefone'  => 'Lorem ipsum dol',
		'banco_id'  => 1,
		'ativo'  => 1
	));
}
?>