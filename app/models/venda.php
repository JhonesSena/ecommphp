<?php
class Venda extends AppModel {

	var $name = 'Venda';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'pedido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Situacao' => array(
			'className' => 'Situacao',
			'foreignKey' => 'situacao_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Boleto' => array(
			'className' => 'Boleto',
			'foreignKey' => 'boleto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>