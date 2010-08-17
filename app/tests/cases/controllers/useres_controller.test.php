<?php 
/* SVN FILE: $Id$ */
/* UseresController Test cases generated on: 2010-07-31 16:28:16 : 1280604496*/
App::import('Controller', 'Useres');

class TestUseres extends UseresController {
	var $autoRender = false;
}

class UseresControllerTest extends CakeTestCase {
	var $Useres = null;

	function startTest() {
		$this->Useres = new TestUseres();
		$this->Useres->constructClasses();
	}

	function testUseresControllerInstance() {
		$this->assertTrue(is_a($this->Useres, 'UseresController'));
	}

	function endTest() {
		unset($this->Useres);
	}
}
?>