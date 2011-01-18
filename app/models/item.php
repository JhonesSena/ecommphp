<?php
class Item extends AppModel {

    var $name = 'Item';
    var $displayField = 'titulo';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
            'Produto' => array(
                            'className' => 'Produto',
                            'foreignKey' => 'produto_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            ),
            'Cor' => array(
                                'className' => 'Cor',
                                'foreignKey' => 'cor_id',
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                )
    );

    var $hasMany = array(
            'ItensPedido' => array(
                            'className' => 'ItensPedido',
                            'foreignKey' => 'item_id',
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

    function beforeFind($query) {
        $new_conditions = array('Item.ativo'=>true);
        if(!empty ($query['conditions'])) {
            $conditions = $query['conditions'];
            $query['conditions'] = Set::merge($conditions, $new_conditions);
        }
        else
            $query['conditions'] = $new_conditions;

        return $query;
    }

    function afterFind($results) {

        if(isset($results)) {
            foreach ($results as $key => $val) {

                if (isset($val['Item']['ativo'])) {
                    if (isset($val['Item'])) {
                        if($val['Item']['ativo']==1) {
                            $results[$key]['Item']['ativo'] = 'Sim';
                        }
                        else
                            $results[$key]['Item']['ativo'] = 'Não';
                    }
                }
            }
        }
        return $results;
    }

}
?>