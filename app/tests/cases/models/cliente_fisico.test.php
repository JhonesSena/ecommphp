<?php 
/* SVN FILE: $Id$ */
/* ClienteFisico Test cases generated on: 2010-07-27 09:30:37 : 1280223037*/
App::import('Model', 'ClienteFisico');

class ClienteFisicoTestCase extends CakeTestCase {
	var $ClienteFisico = null;
	var $fixtures = array('app.cliente_fisico', 'app.cliente');

	function startTest() {
		$this->ClienteFisico =& ClassRegistry::init('ClienteFisico');
	}

	function testClienteFisicoInstance() {
		$this->assertTrue(is_a($this->ClienteFisico, 'ClienteFisico'));
	}

	function testClienteFisicoFind() {
		$this->ClienteFisico->recursive = -1;
		$results = $this->ClienteFisico->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('ClienteFisico' => array(
			'id'  => 1,
			'cliente_id'  => 1,
			'nome'  => 'Lorem ipsum dolor sit amet',
			'cpf'  => 'Lorem ipsum d'
		));
		$this->assertEqual($results, $expected);
	}
}
?>