<?php 
/* SVN FILE: $Id$ */
/* ClientePedidosController Test cases generated on: 2010-07-27 09:45:31 : 1280223931*/
App::import('Controller', 'ClientePedidos');

class TestClientePedidos extends ClientePedidosController {
	var $autoRender = false;
}

class ClientePedidosControllerTest extends CakeTestCase {
	var $ClientePedidos = null;

	function startTest() {
		$this->ClientePedidos = new TestClientePedidos();
		$this->ClientePedidos->constructClasses();
	}

	function testClientePedidosControllerInstance() {
		$this->assertTrue(is_a($this->ClientePedidos, 'ClientePedidosController'));
	}

	function endTest() {
		unset($this->ClientePedidos);
	}
}
?>