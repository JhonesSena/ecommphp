<?php 
/* SVN FILE: $Id$ */
/* Venda Test cases generated on: 2010-07-27 09:32:30 : 1280223150*/
App::import('Model', 'Venda');

class VendaTestCase extends CakeTestCase {
	var $Venda = null;
	var $fixtures = array('app.venda', 'app.pedido', 'app.situacao', 'app.boleto');

	function startTest() {
		$this->Venda =& ClassRegistry::init('Venda');
	}

	function testVendaInstance() {
		$this->assertTrue(is_a($this->Venda, 'Venda'));
	}

	function testVendaFind() {
		$this->Venda->recursive = -1;
		$results = $this->Venda->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Venda' => array(
			'id'  => 1,
			'created'  => '2010-07-27 09:32:30',
			'pedido_id'  => 1,
			'situacao_id'  => 1,
			'boleto_id'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>