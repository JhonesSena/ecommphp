<?php
class ItemReceita extends AppModel {

	var $name = 'ItemReceita';
	var $validate = array(
		'nome' => array('notempty'),
		'descricao' => array('notempty'),
		'sequencia' => array('numeric'),
		'imagem' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Receita' => array(
			'className' => 'Receita',
			'foreignKey' => 'receita_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>