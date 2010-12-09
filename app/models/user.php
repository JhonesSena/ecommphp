<?php
class User extends AppModel {

    var $name = 'User';
    var $useTable = 'users';
    var $displayField = 'username';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
            'Group' => array(
                            'className' => 'Group',
                            'foreignKey' => 'group_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            )
    );

    var $hasOne = array(
            'Cliente' => array(
                            'className' => 'Cliente',
                            'foreignKey' => 'user_id',
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

//    function beforeSave() {
//        print_r($this->data);
//
//        return false;
//    }

    function beforeFind($query) {
//        $new_conditions = array('User.ativo'=>true);
//        if(!empty ($query['conditions'])) {
//            $conditions = $query['conditions'];
//            $query['conditions'] = Set::merge($conditions, $new_conditions);
//        }
//        else
//            $query['conditions'] = $new_conditions;
        
        return $query;
    }
}
?>