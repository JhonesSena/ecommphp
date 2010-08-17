<?php 
/* SVN FILE: $Id$ */
/* Situacao Fixture generated on: 2010-07-27 09:14:58 : 1280222098*/

class SituacaoFixture extends CakeTestFixture {
	var $name = 'Situacao';
	var $table = 'situacoes';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'nome' => array('type'=>'string', 'null' => false, 'length' => 50),
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