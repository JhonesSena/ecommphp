<?php 
/* SVN FILE: $Id$ */
/* ClienteJuridico Fixture generated on: 2010-07-27 09:30:45 : 1280223045*/

class ClienteJuridicoFixture extends CakeTestFixture {
	var $name = 'ClienteJuridico';
	var $table = 'cliente_juridicos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'cliente_id' => array('type'=>'integer', 'null' => false),
		'nome_fantasia' => array('type'=>'string', 'null' => false, 'length' => 70),
		'razao_social' => array('type'=>'string', 'null' => false, 'length' => 70),
		'cnpj' => array('type'=>'string', 'null' => false, 'length' => 15),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'cliente_id'  => 1,
		'nome_fantasia'  => 'Lorem ipsum dolor sit amet',
		'razao_social'  => 'Lorem ipsum dolor sit amet',
		'cnpj'  => 'Lorem ipsum d'
	));
}
?>