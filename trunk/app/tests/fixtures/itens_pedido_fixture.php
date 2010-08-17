<?php 
/* SVN FILE: $Id$ */
/* ItensPedido Fixture generated on: 2010-07-27 09:28:22 : 1280222902*/

class ItensPedidoFixture extends CakeTestFixture {
	var $name = 'ItensPedido';
	var $table = 'itens_pedidos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'pedido_id' => array('type'=>'integer', 'null' => false),
		'produto_id' => array('type'=>'integer', 'null' => false),
		'ativo' => array('type'=>'boolean', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'pedido_id'  => 1,
		'produto_id'  => 1,
		'ativo'  => 1
	));
}
?>