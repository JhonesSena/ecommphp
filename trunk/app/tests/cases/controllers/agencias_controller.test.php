<?php 
/* SVN FILE: $Id$ */
/* AgenciasController Test cases generated on: 2010-07-27 09:41:48 : 1280223708*/
App::import('Controller', 'Agencias');

class TestAgencias extends AgenciasController {
	var $autoRender = false;
}

class AgenciasControllerTest extends CakeTestCase {
	var $Agencias = null;

	function startTest() {
		$this->Agencias = new TestAgencias();
		$this->Agencias->constructClasses();
	}

	function testAgenciasControllerInstance() {
		$this->assertTrue(is_a($this->Agencias, 'AgenciasController'));
	}

	function endTest() {
		unset($this->Agencias);
	}
}
?>