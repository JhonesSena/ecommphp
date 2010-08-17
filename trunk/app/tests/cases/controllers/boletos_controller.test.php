<?php 
/* SVN FILE: $Id$ */
/* BoletosController Test cases generated on: 2010-07-27 09:47:04 : 1280224024*/
App::import('Controller', 'Boletos');

class TestBoletos extends BoletosController {
	var $autoRender = false;
}

class BoletosControllerTest extends CakeTestCase {
	var $Boletos = null;

	function startTest() {
		$this->Boletos = new TestBoletos();
		$this->Boletos->constructClasses();
	}

	function testBoletosControllerInstance() {
		$this->assertTrue(is_a($this->Boletos, 'BoletosController'));
	}

	function endTest() {
		unset($this->Boletos);
	}
}
?>