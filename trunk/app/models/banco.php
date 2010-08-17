<?php
class Banco extends AppModel {

	var $name = 'Banco';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Bloqueto' => array(
			'className' => 'Bloqueto',
			'foreignKey' => 'banco_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Agencia' => array(
			'className' => 'Agencia',
			'foreignKey' => 'banco_id',
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