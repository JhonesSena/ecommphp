<?php
class Pedido extends AppModel {

    var $name = 'Pedido';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
            'SituacaoPedido' => array(
                            'className' => 'SituacaoPedido',
                            'foreignKey' => 'situacao_pedido_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            )
    );

    var $hasOne = array(
            'Venda' => array(
                            'className' => 'Venda',
                            'foreignKey' => 'pedido_id',
                            'dependent' => false,
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            )
    );

    var $hasMany = array(
            'ItensPedido' => array(
                            'className' => 'ItensPedido',
                            'foreignKey' => 'pedido_id',
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

    function beforeSave() {
        if(!empty($this->data['Pedido']['valor_frete'])) {
            $this->data['Pedido']['valor_frete'] = str_replace(',', '.', $this->data['Pedido']['valor_frete']);
        }
        return true;
    }

    function afterFind($results) {

        if(isset($results)) {
            foreach ($results as $key => $val) {
                if (isset($val['Pedido']['valor_frete'])) {

                    if(!empty($results[$key]['Pedido']['valor_frete'])) {
                        $results[$key]['Pedido']['valor_frete'] = str_replace('.', ',', $results[$key]['Pedido']['valor_frete']);
                    }
                }
//                if (isset($val['Pedido']['created'])) {
//
//                    if(!empty($results[$key]['Pedido']['created'])) {
//                        $results[$key]['Pedido']['created'] = $this->formataDateTime($results[$key]['Pedido']['created']);
//                    }
//                }
            }
        }
        return $results;
    }

}
?>