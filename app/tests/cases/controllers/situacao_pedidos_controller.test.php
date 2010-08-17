<?php 
/* SVN FILE: $Id$ */
/* SituacaoPedidosController Test cases generated on: 2010-07-27 09:40:46 : 1280223646*/
App::import('Controller', 'SituacaoPedidos');

class TestSituacaoPedidos extends SituacaoPedidosController {
	var $autoRender = false;
}

class SituacaoPedidosControllerTest extends CakeTestCase {
	var $SituacaoPedidos = null;

	function startTest() {
		$this->SituacaoPedidos = new TestSituacaoPedidos();
		$this->SituacaoPedidos->constructClasses();
	}

	function testSituacaoPedidosControllerInstance() {
		$this->assertTrue(is_a($this->SituacaoPedidos, 'SituacaoPedidosController'));
	}

	function endTest() {
		unset($this->SituacaoPedidos);
	}
}
?>