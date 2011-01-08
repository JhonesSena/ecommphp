<?php
class Empresa extends AppModel {

	var $name = 'Empresa';
	var $validate = array(
		'nome' => array('notempty'),
		'nome_fantasia' => array('notempty'),
		'cnpj' => array('notempty'),
		'logradouro' => array('notempty'),
		'cep' => array('notempty'),
		'bairro' => array('notempty'),
		'cidade' => array('notempty'),
		'estado_id' => array('numeric'),
		'ativo' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Estado' => array(
			'className' => 'Estado',
			'foreignKey' => 'estado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ContatosEmpresa' => array(
			'className' => 'ContatosEmpresa',
			'foreignKey' => 'empresa_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array('ContatosEmpresa.tipo','ContatosEmpresa.valor'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>