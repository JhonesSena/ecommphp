<?php 
/* SVN FILE: $Id$ */
/* Situacao Test cases generated on: 2010-07-27 09:14:58 : 1280222098*/
App::import('Model', 'Situacao');

class SituacaoTestCase extends CakeTestCase {
	var $Situacao = null;
	var $fixtures = array('app.situacao', 'app.situacao_pedido', 'app.venda');

	function startTest() {
		$this->Situacao =& ClassRegistry::init('Situacao');
	}

	function testSituacaoInstance() {
		$this->assertTrue(is_a($this->Situacao, 'Situacao'));
	}

	function testSituacaoFind() {
		$this->Situacao->recursive = -1;
		$results = $this->Situacao->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Situacao' => array(
			'id'  => 1,
			'nome'  => 'Lorem ipsum dolor sit amet',
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>