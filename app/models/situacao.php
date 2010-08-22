<?php
class Situacao extends AppModel {

	var $name = 'Situacao';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Venda' => array(
			'className' => 'Venda',
			'foreignKey' => 'situacao_id',
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
                if (isset($val['Situacao']['ativo'])) {

                    if($results[$key]['Situacao']['ativo']) {
                        $results[$key]['Situacao']['ativo'] = 'Sim';
                    }
                    else
                        $results[$key]['Situacao']['ativo'] = 'Não';
                }
            }
        }
        return $results;
    }

}
?>