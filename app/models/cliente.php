<?php
class Cliente extends AppModel {

	var $name = 'Cliente';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Estado' => array(
			'className' => 'Estado',
			'foreignKey' => 'estado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasOne = array(
		'Cedente' => array(
			'className' => 'Cedente',
			'foreignKey' => 'cliente_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ClienteFisico' => array(
			'className' => 'ClienteFisico',
			'foreignKey' => 'cliente_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ClienteJuridico' => array(
			'className' => 'ClienteJuridico',
			'foreignKey' => 'cliente_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Boleto' => array(
			'className' => 'Boleto',
			'foreignKey' => 'cliente_id',
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
		'ClientePedido' => array(
			'className' => 'ClientePedido',
			'foreignKey' => 'cliente_id',
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