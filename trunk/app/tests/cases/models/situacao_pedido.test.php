<?php 
/* SVN FILE: $Id$ */
/* SituacaoPedido Test cases generated on: 2010-07-27 09:15:15 : 1280222115*/
App::import('Model', 'SituacaoPedido');

class SituacaoPedidoTestCase extends CakeTestCase {
	var $SituacaoPedido = null;
	var $fixtures = array('app.situacao_pedido', 'app.pedido', 'app.situacao');

	function startTest() {
		$this->SituacaoPedido =& ClassRegistry::init('SituacaoPedido');
	}

	function testSituacaoPedidoInstance() {
		$this->assertTrue(is_a($this->SituacaoPedido, 'SituacaoPedido'));
	}

	function testSituacaoPedidoFind() {
		$this->SituacaoPedido->recursive = -1;
		$results = $this->SituacaoPedido->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('SituacaoPedido' => array(
			'id'  => 1,
			'pedido_id'  => 1,
			'data'  => '2010-07-27 09:15:15',
			'situacao_id'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>