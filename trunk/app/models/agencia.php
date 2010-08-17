<?php
class Agencia extends AppModel {

	var $name = 'Agencia';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Banco' => array(
			'className' => 'Banco',
			'foreignKey' => 'banco_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Cedente' => array(
			'className' => 'Cedente',
			'foreignKey' => 'agencia_id',
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