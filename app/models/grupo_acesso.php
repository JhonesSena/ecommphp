<?php
class GrupoAcesso extends AppModel {

	var $name = 'GrupoAcesso';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'grupo_acesso_id',
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