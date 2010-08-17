<?php 
/* SVN FILE: $Id$ */
/* Imagem Test cases generated on: 2010-07-27 09:27:12 : 1280222832*/
App::import('Model', 'Imagem');

class ImagemTestCase extends CakeTestCase {
	var $Imagem = null;
	var $fixtures = array('app.imagem', 'app.produto');

	function startTest() {
		$this->Imagem =& ClassRegistry::init('Imagem');
	}

	function testImagemInstance() {
		$this->assertTrue(is_a($this->Imagem, 'Imagem'));
	}

	function testImagemFind() {
		$this->Imagem->recursive = -1;
		$results = $this->Imagem->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Imagem' => array(
			'id'  => 1,
			'produto_id'  => 1,
			'nome'  => 'Lorem ipsum dolor sit amet',
			'diretorio'  => 'Lorem ipsum dolor sit amet',
			'tamanho_arquivo'  => 'Lorem ipsum dolor ',
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>