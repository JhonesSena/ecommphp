<?php
class Bloqueto extends AppModel {

	var $name = 'Bloqueto';

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
			'foreignKey' => 'bloqueto_id',
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