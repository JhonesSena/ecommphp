<?php
class Agencia extends AppModel {

    var $name = 'Agencia';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
            'Banco' => array(
                            'className' => 'Banco',
                            'foreignKey' => 'banco_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            ),
            'Estado' => array(
                            'className' => 'Estado',
                            'foreignKey' => 'estado_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            )
    );

    var $hasMany = array(
            'Cedente' => array(
                            'className' => 'Cedente',
                            'foreignKey' => 'agencia_id',
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
                if (isset($val['Agencia']['ativo'])) {

                    if($results[$key]['Agencia']['ativo']) {
                        $results[$key]['Agencia']['ativo'] = 'Sim';
                    }
                    else
                        $results[$key]['Agencia']['ativo'] = 'Não';
                }
            }
        }
        return $results;
    }

}
?>