<?php 
/* SVN FILE: $Id$ */
/* CedentesController Test cases generated on: 2010-07-27 09:46:12 : 1280223972*/
App::import('Controller', 'Cedentes');

class TestCedentes extends CedentesController {
	var $autoRender = false;
}

class CedentesControllerTest extends CakeTestCase {
	var $Cedentes = null;

	function startTest() {
		$this->Cedentes = new TestCedentes();
		$this->Cedentes->constructClasses();
	}

	function testCedentesControllerInstance() {
		$this->assertTrue(is_a($this->Cedentes, 'CedentesController'));
	}

	function endTest() {
		unset($this->Cedentes);
	}
}
?>