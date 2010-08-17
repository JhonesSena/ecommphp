<?php 
/* SVN FILE: $Id$ */
/* SituacoesController Test cases generated on: 2010-07-27 09:39:57 : 1280223597*/
App::import('Controller', 'Situacoes');

class TestSituacoes extends SituacoesController {
	var $autoRender = false;
}

class SituacoesControllerTest extends CakeTestCase {
	var $Situacoes = null;

	function startTest() {
		$this->Situacoes = new TestSituacoes();
		$this->Situacoes->constructClasses();
	}

	function testSituacoesControllerInstance() {
		$this->assertTrue(is_a($this->Situacoes, 'SituacoesController'));
	}

	function endTest() {
		unset($this->Situacoes);
	}
}
?>