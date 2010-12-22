<?php
class Receita extends AppModel {

	var $name = 'Receita';
	var $validate = array(
		'nome' => array('notempty'),
		'descricao' => array('notempty'),
		'ativo' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'ItemReceita' => array(
			'className' => 'ItemReceita',
			'foreignKey' => 'receita_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>