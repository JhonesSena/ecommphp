<?php 
/* SVN FILE: $Id$ */
/* SituacaoPedido Fixture generated on: 2010-07-27 09:15:15 : 1280222115*/

class SituacaoPedidoFixture extends CakeTestFixture {
	var $name = 'SituacaoPedido';
	var $table = 'situacao_pedidos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'pedido_id' => array('type'=>'integer', 'null' => false),
		'data' => array('type'=>'datetime', 'null' => false),
		'situacao_id' => array('type'=>'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'pedido_id'  => 1,
		'data'  => '2010-07-27 09:15:15',
		'situacao_id'  => 1
	));
}
?>