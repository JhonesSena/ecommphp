<?php 
/* SVN FILE: $Id$ */
/* Preco Test cases generated on: 2010-08-13 08:37:30 : 1281699450*/
App::import('Model', 'Preco');

class PrecoTestCase extends CakeTestCase {
	var $Preco = null;
	var $fixtures = array('app.preco', 'app.produto');

	function startTest() {
		$this->Preco =& ClassRegistry::init('Preco');
	}

	function testPrecoInstance() {
		$this->assertTrue(is_a($this->Preco, 'Preco'));
	}

	function testPrecoFind() {
		$this->Preco->recursive = -1;
		$results = $this->Preco->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Preco' => array(
			'id'  => 1,
			'created'  => '2010-08-13 08:37:30',
			'expired'  => '2010-08-13 08:37:30',
			'preco'  => '2010-08-13 08:37:30',
			'produto_id'  => 1,
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>