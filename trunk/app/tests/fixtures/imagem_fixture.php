<?php 
/* SVN FILE: $Id$ */
/* Imagem Fixture generated on: 2010-07-27 09:27:12 : 1280222832*/

class ImagemFixture extends CakeTestFixture {
	var $name = 'Imagem';
	var $table = 'imagens';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'produto_id' => array('type'=>'integer', 'null' => false),
		'nome' => array('type'=>'string', 'null' => false, 'length' => 70),
		'diretorio' => array('type'=>'string', 'null' => false, 'length' => 150),
		'tamanho_arquivo' => array('type'=>'string', 'null' => false, 'length' => 20),
		'ativo' => array('type'=>'boolean', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'produto_id'  => 1,
		'nome'  => 'Lorem ipsum dolor sit amet',
		'diretorio'  => 'Lorem ipsum dolor sit amet',
		'tamanho_arquivo'  => 'Lorem ipsum dolor ',
		'ativo'  => 1
	));
}
?>