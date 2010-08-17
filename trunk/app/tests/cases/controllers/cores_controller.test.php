<?php 
/* SVN FILE: $Id$ */
/* CoresController Test cases generated on: 2010-07-27 09:42:56 : 1280223776*/
App::import('Controller', 'Cores');

class TestCores extends CoresController {
	var $autoRender = false;
}

class CoresControllerTest extends CakeTestCase {
	var $Cores = null;

	function startTest() {
		$this->Cores = new TestCores();
		$this->Cores->constructClasses();
	}

	function testCoresControllerInstance() {
		$this->assertTrue(is_a($this->Cores, 'CoresController'));
	}

	function endTest() {
		unset($this->Cores);
	}
}
?>