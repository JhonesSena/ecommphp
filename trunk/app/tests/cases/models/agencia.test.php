<?php 
/* SVN FILE: $Id$ */
/* Agencia Test cases generated on: 2010-07-27 09:25:08 : 1280222708*/
App::import('Model', 'Agencia');

class AgenciaTestCase extends CakeTestCase {
	var $Agencia = null;
	var $fixtures = array('app.agencia', 'app.cidade', 'app.banco', 'app.cedente');

	function startTest() {
		$this->Agencia =& ClassRegistry::init('Agencia');
	}

	function testAgenciaInstance() {
		$this->assertTrue(is_a($this->Agencia, 'Agencia'));
	}

	function testAgenciaFind() {
		$this->Agencia->recursive = -1;
		$results = $this->Agencia->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Agencia' => array(
			'id'  => 1,
			'codigo'  => 'Lorem ip',
			'codigo_cedente'  => 'Lorem ipsum dolor sit amet',
			'logradouro'  => 'Lorem ipsum dolor sit amet',
			'bairro'  => 'Lorem ipsum dolor sit amet',
			'cidade_id'  => 1,
			'telefone'  => 'Lorem ipsum dol',
			'banco_id'  => 1,
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>