<?php 
/* SVN FILE: $Id$ */
/* Cliente Fixture generated on: 2010-07-31 16:22:26 : 1280604146*/

class ClienteFixture extends CakeTestFixture {
	var $name = 'Cliente';
	var $table = 'clientes';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'telefone' => array('type'=>'string', 'null' => false, 'length' => 17),
		'email' => array('type'=>'string', 'null' => false, 'length' => 70),
		'logradouro' => array('type'=>'string', 'null' => false, 'length' => 150),
		'cep' => array('type'=>'string', 'null' => false, 'length' => 9),
		'bairro' => array('type'=>'string', 'null' => false, 'length' => 45),
		'cidade' => array('type'=>'string', 'null' => false, 'length' => 50),
		'estado_id' => array('type'=>'integer', 'null' => false),
		'login' => array('type'=>'string', 'null' => true, 'length' => 25),
		'senha' => array('type'=>'string', 'null' => true, 'length' => 25),
		'user_id' => array('type'=>'integer', 'null' => false),
		'ativo' => array('type'=>'boolean', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'telefone'  => 'Lorem ipsum dol',
		'email'  => 'Lorem ipsum dolor sit amet',
		'logradouro'  => 'Lorem ipsum dolor sit amet',
		'cep'  => 'Lorem i',
		'bairro'  => 'Lorem ipsum dolor sit amet',
		'cidade'  => 'Lorem ipsum dolor sit amet',
		'estado_id'  => 1,
		'login'  => 'Lorem ipsum dolor sit a',
		'senha'  => 'Lorem ipsum dolor sit a',
		'user_id'  => 1,
		'ativo'  => 1
	));
}
?>