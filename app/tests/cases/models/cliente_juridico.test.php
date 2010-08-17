<?php 
/* SVN FILE: $Id$ */
/* ClienteJuridico Test cases generated on: 2010-07-27 09:30:45 : 1280223045*/
App::import('Model', 'ClienteJuridico');

class ClienteJuridicoTestCase extends CakeTestCase {
	var $ClienteJuridico = null;
	var $fixtures = array('app.cliente_juridico', 'app.cliente');

	function startTest() {
		$this->ClienteJuridico =& ClassRegistry::init('ClienteJuridico');
	}

	function testClienteJuridicoInstance() {
		$this->assertTrue(is_a($this->ClienteJuridico, 'ClienteJuridico'));
	}

	function testClienteJuridicoFind() {
		$this->ClienteJuridico->recursive = -1;
		$results = $this->ClienteJuridico->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('ClienteJuridico' => array(
			'id'  => 1,
			'cliente_id'  => 1,
			'nome_fantasia'  => 'Lorem ipsum dolor sit amet',
			'razao_social'  => 'Lorem ipsum dolor sit amet',
			'cnpj'  => 'Lorem ipsum d'
		));
		$this->assertEqual($results, $expected);
	}
}
?>