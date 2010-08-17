<?php 
/* SVN FILE: $Id$ */
/* Cidade Test cases generated on: 2010-07-27 09:23:25 : 1280222605*/
App::import('Model', 'Cidade');

class CidadeTestCase extends CakeTestCase {
	var $Cidade = null;
	var $fixtures = array('app.cidade', 'app.estado', 'app.agencia', 'app.cliente');

	function startTest() {
		$this->Cidade =& ClassRegistry::init('Cidade');
	}

	function testCidadeInstance() {
		$this->assertTrue(is_a($this->Cidade, 'Cidade'));
	}

	function testCidadeFind() {
		$this->Cidade->recursive = -1;
		$results = $this->Cidade->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Cidade' => array(
			'id'  => 1,
			'estado_id'  => 1,
			'nome'  => 'Lorem ipsum dolor sit amet',
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>