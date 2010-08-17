<?php 
/* SVN FILE: $Id$ */
/* ProdutoCor Fixture generated on: 2010-07-27 09:28:45 : 1280222925*/

class ProdutoCorFixture extends CakeTestFixture {
	var $name = 'ProdutoCor';
	var $table = 'produto_cores';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'produto_id' => array('type'=>'integer', 'null' => false),
		'cor_id' => array('type'=>'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'produto_id'  => 1,
		'cor_id'  => 1
	));
}
?>