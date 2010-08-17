<?php 
/* SVN FILE: $Id$ */
/* Banco Fixture generated on: 2010-07-27 09:13:18 : 1280221998*/

class BancoFixture extends CakeTestFixture {
	var $name = 'Banco';
	var $table = 'bancos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'nome' => array('type'=>'string', 'null' => false, 'length' => 100),
		'codigo_compensacao' => array('type'=>'string', 'null' => false, 'length' => 10),
		'imagem' => array('type'=>'string', 'null' => false, 'length' => 200),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'nome'  => 'Lorem ipsum dolor sit amet',
		'codigo_compensacao'  => 'Lorem ip',
		'imagem'  => 'Lorem ipsum dolor sit amet'
	));
}
?>