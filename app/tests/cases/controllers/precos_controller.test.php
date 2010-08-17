<?php 
/* SVN FILE: $Id$ */
/* PrecosController Test cases generated on: 2010-08-13 08:37:44 : 1281699464*/
App::import('Controller', 'Precos');

class TestPrecos extends PrecosController {
	var $autoRender = false;
}

class PrecosControllerTest extends CakeTestCase {
	var $Precos = null;

	function startTest() {
		$this->Precos = new TestPrecos();
		$this->Precos->constructClasses();
	}

	function testPrecosControllerInstance() {
		$this->assertTrue(is_a($this->Precos, 'PrecosController'));
	}

	function endTest() {
		unset($this->Precos);
	}
}
?>