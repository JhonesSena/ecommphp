<?php
class Situacao extends AppModel {

	var $name = 'Situacao';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Venda' => array(
			'className' => 'Venda',
			'foreignKey' => 'situacao_id',
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