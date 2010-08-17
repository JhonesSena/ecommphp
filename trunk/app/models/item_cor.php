<?php
class ItemCor extends AppModel {

	var $name = 'ItemCor';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Cor' => array(
			'className' => 'Cor',
			'foreignKey' => 'cor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>