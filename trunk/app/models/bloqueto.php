<?php
class Bloqueto extends AppModel {

	var $name = 'Bloqueto';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Banco' => array(
			'className' => 'Banco',
			'foreignKey' => 'banco_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Cedente' => array(
			'className' => 'Cedente',
			'foreignKey' => 'bloqueto_id',
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

        function afterFind($results) {

        if(isset($results)) {
            foreach ($results as $key => $val) {
                if (isset($val['Bloqueto']['ativo'])) {

                    if($results[$key]['Bloqueto']['ativo']) {
                        $results[$key]['Bloqueto']['ativo'] = 'Sim';
                    }
                    else
                        $results[$key]['Bloqueto']['ativo'] = 'Não';
                }
            }
        }
        return $results;
    }

}
?>