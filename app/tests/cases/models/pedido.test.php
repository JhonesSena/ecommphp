<?php 
/* SVN FILE: $Id$ */
/* Pedido Test cases generated on: 2010-08-13 07:06:00 : 1281693960*/
App::import('Model', 'Pedido');

class PedidoTestCase extends CakeTestCase {
	var $Pedido = null;
	var $fixtures = array('app.pedido', 'app.situacao', 'app.venda', 'app.itens_pedido');

	function startTest() {
		$this->Pedido =& ClassRegistry::init('Pedido');
	}

	function testPedidoInstance() {
		$this->assertTrue(is_a($this->Pedido, 'Pedido'));
	}

	function testPedidoFind() {
		$this->Pedido->recursive = -1;
		$results = $this->Pedido->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Pedido' => array(
			'id'  => 1,
			'valor_frete'  => 1,
			'situacao_id'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>