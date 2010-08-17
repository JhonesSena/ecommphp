<?php 
/* SVN FILE: $Id$ */
/* Cedente Test cases generated on: 2010-07-27 09:31:51 : 1280223111*/
App::import('Model', 'Cedente');

class CedenteTestCase extends CakeTestCase {
	var $Cedente = null;
	var $fixtures = array('app.cedente', 'app.cliente', 'app.agencia', 'app.bloqueto', 'app.boleto');

	function startTest() {
		$this->Cedente =& ClassRegistry::init('Cedente');
	}

	function testCedenteInstance() {
		$this->assertTrue(is_a($this->Cedente, 'Cedente'));
	}

	function testCedenteFind() {
		$this->Cedente->recursive = -1;
		$results = $this->Cedente->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Cedente' => array(
			'id'  => 1,
			'conta_corrente'  => 'Lorem ip',
			'cliente_id'  => 1,
			'agencia_id'  => 1,
			'bloqueto_id'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>