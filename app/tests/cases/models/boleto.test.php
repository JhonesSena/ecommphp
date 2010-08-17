<?php 
/* SVN FILE: $Id$ */
/* Boleto Test cases generated on: 2010-07-27 09:32:57 : 1280223177*/
App::import('Model', 'Boleto');

class BoletoTestCase extends CakeTestCase {
	var $Boleto = null;
	var $fixtures = array('app.boleto', 'app.cedente', 'app.cliente', 'app.venda');

	function startTest() {
		$this->Boleto =& ClassRegistry::init('Boleto');
	}

	function testBoletoInstance() {
		$this->assertTrue(is_a($this->Boleto, 'Boleto'));
	}

	function testBoletoFind() {
		$this->Boleto->recursive = -1;
		$results = $this->Boleto->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Boleto' => array(
			'id'  => 1,
			'numero'  => 'Lorem ipsum dolor sit amet',
			'nosso_numero'  => 'Lorem ipsum dolor sit amet',
			'emissao'  => '2010-07-27',
			'status'  => 'Lorem ip',
			'vencimento'  => '2010-07-27',
			'cedente_id'  => 1,
			'cliente_id'  => 1,
			'valor'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>