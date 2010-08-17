<?php 
/* SVN FILE: $Id$ */
/* Boleto Fixture generated on: 2010-07-27 09:32:57 : 1280223177*/

class BoletoFixture extends CakeTestFixture {
	var $name = 'Boleto';
	var $table = 'boletos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'numero' => array('type'=>'string', 'null' => false, 'length' => 70),
		'nosso_numero' => array('type'=>'string', 'null' => false, 'length' => 70),
		'emissao' => array('type'=>'date', 'null' => false),
		'status' => array('type'=>'string', 'null' => false, 'length' => 10),
		'vencimento' => array('type'=>'date', 'null' => false),
		'cedente_id' => array('type'=>'integer', 'null' => false),
		'cliente_id' => array('type'=>'integer', 'null' => false),
		'valor' => array('type'=>'float', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
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
}
?>