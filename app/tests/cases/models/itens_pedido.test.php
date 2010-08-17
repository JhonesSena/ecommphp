<?php 
/* SVN FILE: $Id$ */
/* ItensPedido Test cases generated on: 2010-07-27 09:28:22 : 1280222902*/
App::import('Model', 'ItensPedido');

class ItensPedidoTestCase extends CakeTestCase {
	var $ItensPedido = null;
	var $fixtures = array('app.itens_pedido');

	function startTest() {
		$this->ItensPedido =& ClassRegistry::init('ItensPedido');
	}

	function testItensPedidoInstance() {
		$this->assertTrue(is_a($this->ItensPedido, 'ItensPedido'));
	}

	function testItensPedidoFind() {
		$this->ItensPedido->recursive = -1;
		$results = $this->ItensPedido->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('ItensPedido' => array(
			'id'  => 1,
			'pedido_id'  => 1,
			'produto_id'  => 1,
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>