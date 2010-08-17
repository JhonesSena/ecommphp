<?php 
/* SVN FILE: $Id$ */
/* Banco Test cases generated on: 2010-07-27 09:13:18 : 1280221998*/
App::import('Model', 'Banco');

class BancoTestCase extends CakeTestCase {
	var $Banco = null;
	var $fixtures = array('app.banco', 'app.bloqueto', 'app.agencia');

	function startTest() {
		$this->Banco =& ClassRegistry::init('Banco');
	}

	function testBancoInstance() {
		$this->assertTrue(is_a($this->Banco, 'Banco'));
	}

	function testBancoFind() {
		$this->Banco->recursive = -1;
		$results = $this->Banco->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Banco' => array(
			'id'  => 1,
			'nome'  => 'Lorem ipsum dolor sit amet',
			'codigo_compensacao'  => 'Lorem ip',
			'imagem'  => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>