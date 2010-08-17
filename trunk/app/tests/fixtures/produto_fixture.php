<?php 
/* SVN FILE: $Id$ */
/* Produto Fixture generated on: 2010-07-27 09:30:13 : 1280223013*/

class ProdutoFixture extends CakeTestFixture {
	var $name = 'Produto';
	var $table = 'produtos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'codigo' => array('type'=>'integer', 'null' => false),
		'titulo' => array('type'=>'string', 'null' => false, 'length' => 40),
		'linha_id' => array('type'=>'integer', 'null' => false),
		'grupo_id' => array('type'=>'integer', 'null' => false),
		'metragem' => array('type'=>'float', 'null' => false),
		'pacote' => array('type'=>'integer', 'null' => false),
		'peso' => array('type'=>'integer', 'null' => false),
		'ativo' => array('type'=>'boolean', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'codigo'  => 1,
		'titulo'  => 'Lorem ipsum dolor sit amet',
		'linha_id'  => 1,
		'grupo_id'  => 1,
		'metragem'  => 1,
		'pacote'  => 1,
		'peso'  => 1,
		'ativo'  => 1
	));
}
?>