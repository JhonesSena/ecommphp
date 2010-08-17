<?php 
/* SVN FILE: $Id$ */
/* LinhasController Test cases generated on: 2010-07-27 09:42:42 : 1280223762*/
App::import('Controller', 'Linhas');

class TestLinhas extends LinhasController {
	var $autoRender = false;
}

class LinhasControllerTest extends CakeTestCase {
	var $Linhas = null;

	function startTest() {
		$this->Linhas = new TestLinhas();
		$this->Linhas->constructClasses();
	}

	function testLinhasControllerInstance() {
		$this->assertTrue(is_a($this->Linhas, 'LinhasController'));
	}

	function endTest() {
		unset($this->Linhas);
	}
}
?>