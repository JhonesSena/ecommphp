<?php 
/* SVN FILE: $Id$ */
/* Linha Test cases generated on: 2010-07-27 09:26:51 : 1280222811*/
App::import('Model', 'Linha');

class LinhaTestCase extends CakeTestCase {
	var $Linha = null;
	var $fixtures = array('app.linha', 'app.produto');

	function startTest() {
		$this->Linha =& ClassRegistry::init('Linha');
	}

	function testLinhaInstance() {
		$this->assertTrue(is_a($this->Linha, 'Linha'));
	}

	function testLinhaFind() {
		$this->Linha->recursive = -1;
		$results = $this->Linha->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Linha' => array(
			'id'  => 1,
			'nome'  => 'Lorem ipsum dolor sit amet',
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>