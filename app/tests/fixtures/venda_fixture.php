<?php 
/* SVN FILE: $Id$ */
/* Venda Fixture generated on: 2010-07-27 09:32:30 : 1280223150*/

class VendaFixture extends CakeTestFixture {
	var $name = 'Venda';
	var $table = 'vendas';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'created' => array('type'=>'datetime', 'null' => false),
		'pedido_id' => array('type'=>'integer', 'null' => false),
		'situacao_id' => array('type'=>'integer', 'null' => false),
		'boleto_id' => array('type'=>'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'created'  => '2010-07-27 09:32:30',
		'pedido_id'  => 1,
		'situacao_id'  => 1,
		'boleto_id'  => 1
	));
}
?>