<?php 
/* SVN FILE: $Id$ */
/* BancosController Test cases generated on: 2010-07-27 09:39:31 : 1280223571*/
App::import('Controller', 'Bancos');

class TestBancos extends BancosController {
	var $autoRender = false;
}

class BancosControllerTest extends CakeTestCase {
	var $Bancos = null;

	function startTest() {
		$this->Bancos = new TestBancos();
		$this->Bancos->constructClasses();
	}

	function testBancosControllerInstance() {
		$this->assertTrue(is_a($this->Bancos, 'BancosController'));
	}

	function endTest() {
		unset($this->Bancos);
	}
}
?>