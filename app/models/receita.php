<?php
class Receita extends AppModel {

	var $name = 'Receita';
        var $order = 'Receita.nome';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'ItemReceita' => array(
			'className' => 'ItemReceita',
			'foreignKey' => 'receita_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'ItemReceita.sequencia',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Material' => array(
			'className' => 'Material',
			'foreignKey' => 'receita_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Material.nome',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>