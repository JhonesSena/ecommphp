<?php 
/* SVN FILE: $Id$ */
/* Cor Test cases generated on: 2010-07-27 09:25:45 : 1280222745*/
App::import('Model', 'Cor');

class CorTestCase extends CakeTestCase {
	var $Cor = null;
	var $fixtures = array('app.cor');

	function startTest() {
		$this->Cor =& ClassRegistry::init('Cor');
	}

	function testCorInstance() {
		$this->assertTrue(is_a($this->Cor, 'Cor'));
	}

	function testCorFind() {
		$this->Cor->recursive = -1;
		$results = $this->Cor->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Cor' => array(
			'id'  => 1,
			'nome'  => 'Lorem ipsum dolor sit amet',
			'red'  => 1,
			'gren'  => 1,
			'blue'  => 1,
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>