<?php 
/* SVN FILE: $Id$ */
/* ProdutoCor Test cases generated on: 2010-07-27 09:28:45 : 1280222925*/
App::import('Model', 'ProdutoCor');

class ProdutoCorTestCase extends CakeTestCase {
	var $ProdutoCor = null;
	var $fixtures = array('app.produto_cor');

	function startTest() {
		$this->ProdutoCor =& ClassRegistry::init('ProdutoCor');
	}

	function testProdutoCorInstance() {
		$this->assertTrue(is_a($this->ProdutoCor, 'ProdutoCor'));
	}

	function testProdutoCorFind() {
		$this->ProdutoCor->recursive = -1;
		$results = $this->ProdutoCor->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('ProdutoCor' => array(
			'id'  => 1,
			'produto_id'  => 1,
			'cor_id'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>