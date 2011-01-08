<?php
class Material extends AppModel {

	var $name = 'Material';
	var $validate = array(
		'nome' => array('notempty'),
		'receita_id' => array('numeric')
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