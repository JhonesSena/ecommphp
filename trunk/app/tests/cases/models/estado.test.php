<?php 
/* SVN FILE: $Id$ */
/* Estado Test cases generated on: 2010-07-27 09:22:49 : 1280222569*/
App::import('Model', 'Estado');

class EstadoTestCase extends CakeTestCase {
	var $Estado = null;
	var $fixtures = array('app.estado', 'app.cidade');

	function startTest() {
		$this->Estado =& ClassRegistry::init('Estado');
	}

	function testEstadoInstance() {
		$this->assertTrue(is_a($this->Estado, 'Estado'));
	}

	function testEstadoFind() {
		$this->Estado->recursive = -1;
		$results = $this->Estado->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Estado' => array(
			'id'  => 1,
			'nome'  => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>