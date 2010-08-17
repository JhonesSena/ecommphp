<?php 
/* SVN FILE: $Id$ */
/* PedidosController Test cases generated on: 2010-07-27 09:41:25 : 1280223685*/
App::import('Controller', 'Pedidos');

class TestPedidos extends PedidosController {
	var $autoRender = false;
}

class PedidosControllerTest extends CakeTestCase {
	var $Pedidos = null;

	function startTest() {
		$this->Pedidos = new TestPedidos();
		$this->Pedidos->constructClasses();
	}

	function testPedidosControllerInstance() {
		$this->assertTrue(is_a($this->Pedidos, 'PedidosController'));
	}

	function endTest() {
		unset($this->Pedidos);
	}
}
?>