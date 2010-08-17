<?php 
/* SVN FILE: $Id$ */
/* Pedido Fixture generated on: 2010-08-13 07:05:58 : 1281693958*/

class PedidoFixture extends CakeTestFixture {
	var $name = 'Pedido';
	var $table = 'pedidos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'valor_frete' => array('type'=>'float', 'null' => true),
		'situacao_id' => array('type'=>'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'valor_frete'  => 1,
		'situacao_id'  => 1
	));
}
?>