<?php 
/* SVN FILE: $Id$ */
/* Bloqueto Test cases generated on: 2010-07-27 09:14:33 : 1280222073*/
App::import('Model', 'Bloqueto');

class BloquetoTestCase extends CakeTestCase {
	var $Bloqueto = null;
	var $fixtures = array('app.bloqueto', 'app.banco', 'app.cedente');

	function startTest() {
		$this->Bloqueto =& ClassRegistry::init('Bloqueto');
	}

	function testBloquetoInstance() {
		$this->assertTrue(is_a($this->Bloqueto, 'Bloqueto'));
	}

	function testBloquetoFind() {
		$this->Bloqueto->recursive = -1;
		$results = $this->Bloqueto->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Bloqueto' => array(
			'id'  => 1,
			'banco_id'  => 1,
			'local_pagamento'  => 'Lorem ipsum dolor sit amet',
			'carteira'  => 'Lorem ip',
			'tipo'  => 'Lorem ipsum dolor sit amet',
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>