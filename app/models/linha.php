<?php
class Linha extends AppModel {

	var $name = 'Linha';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Produto' => array(
			'className' => 'Produto',
			'foreignKey' => 'linha_id',
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