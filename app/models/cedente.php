<?php
class Cedente extends AppModel {

	var $name = 'Cedente';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Agencia' => array(
			'className' => 'Agencia',
			'foreignKey' => 'agencia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Bloqueto' => array(
			'className' => 'Bloqueto',
			'foreignKey' => 'bloqueto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Boleto' => array(
			'className' => 'Boleto',
			'foreignKey' => 'cedente_id',
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