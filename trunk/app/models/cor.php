<?php
class Cor extends AppModel {

	var $name = 'Cor';
        var $order = array('Cor.nome');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'cor_id',
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
                if (isset($val['Cor']['ativo'])) {
                    if (isset($val['Cor'])) {
                        if($val['Cor']['ativo']==1) {
                            $results[$key]['Cor']['ativo'] = 'Sim';
                        }
                        else
                            $results[$key]['Cor']['ativo'] = 'Não';
                    }
                }
            }
        }
        return $results;
    }

}
?>