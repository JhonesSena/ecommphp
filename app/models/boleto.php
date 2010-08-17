<?php
class Boleto extends AppModel {

	var $name = 'Boleto';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Cedente' => array(
			'className' => 'Cedente',
			'foreignKey' => 'cedente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Venda' => array(
			'className' => 'Venda',
			'foreignKey' => 'boleto_id',
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