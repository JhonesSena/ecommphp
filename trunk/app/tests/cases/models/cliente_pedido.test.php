<?php 
/* SVN FILE: $Id$ */
/* ClientePedido Test cases generated on: 2010-07-27 09:30:58 : 1280223058*/
App::import('Model', 'ClientePedido');

class ClientePedidoTestCase extends CakeTestCase {
	var $ClientePedido = null;
	var $fixtures = array('app.cliente_pedido', 'app.cliente', 'app.pedido');

	function startTest() {
		$this->ClientePedido =& ClassRegistry::init('ClientePedido');
	}

	function testClientePedidoInstance() {
		$this->assertTrue(is_a($this->ClientePedido, 'ClientePedido'));
	}

	function testClientePedidoFind() {
		$this->ClientePedido->recursive = -1;
		$results = $this->ClientePedido->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('ClientePedido' => array(
			'id'  => 1,
			'cliente_id'  => 1,
			'pedido_id'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>