<?php
class SituacaoPedido extends AppModel {

    var $name = 'SituacaoPedido';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $hasMany = array(
            'Pedido' => array(
                            'className' => 'Pedido',
                            'foreignKey' => 'situacao_pedido_id',
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
                if (isset($val['SituacaoPedido']['ativo'])) {
                    
                    if($results[$key]['SituacaoPedido']['ativo']) {
                        $results[$key]['SituacaoPedido']['ativo'] = 'Sim';
                    }
                    else
                        $results[$key]['SituacaoPedido']['ativo'] = 'Não';
                }
            }
        }
        return $results;
    }

}
?>