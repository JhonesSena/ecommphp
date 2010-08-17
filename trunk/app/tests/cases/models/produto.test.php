<?php 
/* SVN FILE: $Id$ */
/* Produto Test cases generated on: 2010-07-27 09:30:13 : 1280223013*/
App::import('Model', 'Produto');

class ProdutoTestCase extends CakeTestCase {
	var $Produto = null;
	var $fixtures = array('app.produto', 'app.linha', 'app.grupo', 'app.imagem', 'app.itens_pedido', 'app.produto_cor');

	function startTest() {
		$this->Produto =& ClassRegistry::init('Produto');
	}

	function testProdutoInstance() {
		$this->assertTrue(is_a($this->Produto, 'Produto'));
	}

	function testProdutoFind() {
		$this->Produto->recursive = -1;
		$results = $this->Produto->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Produto' => array(
			'id'  => 1,
			'codigo'  => 1,
			'titulo'  => 'Lorem ipsum dolor sit amet',
			'linha_id'  => 1,
			'grupo_id'  => 1,
			'metragem'  => 1,
			'pacote'  => 1,
			'peso'  => 1,
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>