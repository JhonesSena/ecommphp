<?php 
/* SVN FILE: $Id$ */
/* VendasController Test cases generated on: 2010-07-27 09:46:22 : 1280223982*/
App::import('Controller', 'Vendas');

class TestVendas extends VendasController {
	var $autoRender = false;
}

class VendasControllerTest extends CakeTestCase {
	var $Vendas = null;

	function startTest() {
		$this->Vendas = new TestVendas();
		$this->Vendas->constructClasses();
	}

	function testVendasControllerInstance() {
		$this->assertTrue(is_a($this->Vendas, 'VendasController'));
	}

	function endTest() {
		unset($this->Vendas);
	}
}
?>