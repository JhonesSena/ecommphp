<?php 
/* SVN FILE: $Id$ */
/* Grupo Test cases generated on: 2010-07-27 09:26:29 : 1280222789*/
App::import('Model', 'Grupo');

class GrupoTestCase extends CakeTestCase {
	var $Grupo = null;
	var $fixtures = array('app.grupo', 'app.produto');

	function startTest() {
		$this->Grupo =& ClassRegistry::init('Grupo');
	}

	function testGrupoInstance() {
		$this->assertTrue(is_a($this->Grupo, 'Grupo'));
	}

	function testGrupoFind() {
		$this->Grupo->recursive = -1;
		$results = $this->Grupo->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Grupo' => array(
			'id'  => 1,
			'nome'  => 'Lorem ipsum dolor sit amet',
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>