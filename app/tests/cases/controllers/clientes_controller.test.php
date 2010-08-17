<?php 
/* SVN FILE: $Id$ */
/* ClientesController Test cases generated on: 2010-07-27 09:45:50 : 1280223950*/
App::import('Controller', 'Clientes');

class TestClientes extends ClientesController {
	var $autoRender = false;
}

class ClientesControllerTest extends CakeTestCase {
	var $Clientes = null;

	function startTest() {
		$this->Clientes = new TestClientes();
		$this->Clientes->constructClasses();
	}

	function testClientesControllerInstance() {
		$this->assertTrue(is_a($this->Clientes, 'ClientesController'));
	}

	function endTest() {
		unset($this->Clientes);
	}
}
?>