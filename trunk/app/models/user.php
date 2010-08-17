<?php
class User extends AppModel {

    var $name = 'User';
    var $useTable = 'users';

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

    var $hasMany = array(
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
}
?>