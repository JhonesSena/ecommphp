<?php 
/* SVN FILE: $Id$ */
/* GruposController Test cases generated on: 2010-07-27 09:42:26 : 1280223746*/
App::import('Controller', 'Grupos');

class TestGrupos extends GruposController {
	var $autoRender = false;
}

class GruposControllerTest extends CakeTestCase {
	var $Grupos = null;

	function startTest() {
		$this->Grupos = new TestGrupos();
		$this->Grupos->constructClasses();
	}

	function testGruposControllerInstance() {
		$this->assertTrue(is_a($this->Grupos, 'GruposController'));
	}

	function endTest() {
		unset($this->Grupos);
	}
}
?>