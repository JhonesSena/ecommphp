<?php
class Estado extends AppModel {

	var $name = 'Estado';

        var $hasMany = array(
                'Agencia' => array(
			'className' => 'Agencia',
			'foreignKey' => 'estado_id',
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