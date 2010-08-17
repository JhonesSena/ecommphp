<?php 
/* SVN FILE: $Id$ */
/* BloquetosController Test cases generated on: 2010-07-27 09:39:46 : 1280223586*/
App::import('Controller', 'Bloquetos');

class TestBloquetos extends BloquetosController {
	var $autoRender = false;
}

class BloquetosControllerTest extends CakeTestCase {
	var $Bloquetos = null;

	function startTest() {
		$this->Bloquetos = new TestBloquetos();
		$this->Bloquetos->constructClasses();
	}

	function testBloquetosControllerInstance() {
		$this->assertTrue(is_a($this->Bloquetos, 'BloquetosController'));
	}

	function endTest() {
		unset($this->Bloquetos);
	}
}
?>