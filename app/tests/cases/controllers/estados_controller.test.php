<?php 
/* SVN FILE: $Id$ */
/* EstadosController Test cases generated on: 2010-07-27 09:41:32 : 1280223692*/
App::import('Controller', 'Estados');

class TestEstados extends EstadosController {
	var $autoRender = false;
}

class EstadosControllerTest extends CakeTestCase {
	var $Estados = null;

	function startTest() {
		$this->Estados = new TestEstados();
		$this->Estados->constructClasses();
	}

	function testEstadosControllerInstance() {
		$this->assertTrue(is_a($this->Estados, 'EstadosController'));
	}

	function endTest() {
		unset($this->Estados);
	}
}
?>