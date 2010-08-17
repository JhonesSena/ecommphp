<?php 
/* SVN FILE: $Id$ */
/* Cliente Test cases generated on: 2010-07-31 16:22:28 : 1280604148*/
App::import('Model', 'Cliente');

class ClienteTestCase extends CakeTestCase {
	var $Cliente = null;
	var $fixtures = array('app.cliente', 'app.estado', 'app.user', 'app.cedente', 'app.cliente_fisico', 'app.cliente_juridico', 'app.boleto', 'app.cliente_pedido');

	function startTest() {
		$this->Cliente =& ClassRegistry::init('Cliente');
	}

	function testClienteInstance() {
		$this->assertTrue(is_a($this->Cliente, 'Cliente'));
	}

	function testClienteFind() {
		$this->Cliente->recursive = -1;
		$results = $this->Cliente->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Cliente' => array(
			'id'  => 1,
			'telefone'  => 'Lorem ipsum dol',
			'email'  => 'Lorem ipsum dolor sit amet',
			'logradouro'  => 'Lorem ipsum dolor sit amet',
			'cep'  => 'Lorem i',
			'bairro'  => 'Lorem ipsum dolor sit amet',
			'cidade'  => 'Lorem ipsum dolor sit amet',
			'estado_id'  => 1,
			'login'  => 'Lorem ipsum dolor sit a',
			'senha'  => 'Lorem ipsum dolor sit a',
			'user_id'  => 1,
			'ativo'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>