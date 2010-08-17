<?php 
/* SVN FILE: $Id$ */
/* ProdutosController Test cases generated on: 2010-07-27 09:44:39 : 1280223879*/
App::import('Controller', 'Produtos');

class TestProdutos extends ProdutosController {
	var $autoRender = false;
}

class ProdutosControllerTest extends CakeTestCase {
	var $Produtos = null;

	function startTest() {
		$this->Produtos = new TestProdutos();
		$this->Produtos->constructClasses();
	}

	function testProdutosControllerInstance() {
		$this->assertTrue(is_a($this->Produtos, 'ProdutosController'));
	}

	function endTest() {
		unset($this->Produtos);
	}
}
?>