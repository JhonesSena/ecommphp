<?php
class ContatosEmpresa extends AppModel {

	var $name = 'ContatosEmpresa';
	var $validate = array(
		'tipo' => array('notempty'),
		'valor' => array('notempty'),
		'empresa_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Empresa' => array(
			'className' => 'Empresa',
			'foreignKey' => 'empresa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>