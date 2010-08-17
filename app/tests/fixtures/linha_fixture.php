<?php 
/* SVN FILE: $Id$ */
/* Linha Fixture generated on: 2010-07-27 09:26:51 : 1280222811*/

class LinhaFixture extends CakeTestFixture {
	var $name = 'Linha';
	var $table = 'linhas';
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