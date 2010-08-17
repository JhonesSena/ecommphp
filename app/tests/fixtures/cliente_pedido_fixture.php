<?php 
/* SVN FILE: $Id$ */
/* ClientePedido Fixture generated on: 2010-07-27 09:30:58 : 1280223058*/

class ClientePedidoFixture extends CakeTestFixture {
	var $name = 'ClientePedido';
	var $table = 'cliente_pedidos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'cliente_id' => array('type'=>'integer', 'null' => false),
		'pedido_id' => array('type'=>'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'cliente_id'  => 1,
		'pedido_id'  => 1
	));
}
?>