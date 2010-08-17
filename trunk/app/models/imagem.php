<?php
class Imagem extends AppModel {

    var $name = 'Imagem';
    var $displayField = 'nome';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
            'Produto' => array(
                            'className' => 'Produto',
                            'foreignKey' => 'produto_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            )
    );

    function beforeFind($query) {
        $new_conditions = array('Imagem.ativo'=>true);
        if(!empty ($query['conditions'])) {
            $conditions = $query['conditions'];
            $query['conditions'] = Set::merge($conditions, $new_conditions);
        }
        else
            $query['conditions'] = $new_conditions;
        
        return $query;
    }

}
?>