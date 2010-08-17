<?php 
/* SVN FILE: $Id$ */
/* CidadesController Test cases generated on: 2010-07-27 09:41:41 : 1280223701*/
App::import('Controller', 'Cidades');

class TestCidades extends CidadesController {
	var $autoRender = false;
}

class CidadesControllerTest extends CakeTestCase {
	var $Cidades = null;

	function startTest() {
		$this->Cidades = new TestCidades();
		$this->Cidades->constructClasses();
	}

	function testCidadesControllerInstance() {
		$this->assertTrue(is_a($this->Cidades, 'CidadesController'));
	}

	function endTest() {
		unset($this->Cidades);
	}
}
?>