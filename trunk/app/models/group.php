<?php
class Group extends AppModel {

    var $name = 'Group';
    var $displayField = 'name';
    var $order = array('name');

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $hasMany = array(
            'User' => array(
                            'className' => 'User',
                            'foreignKey' => 'group_id',
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

    var $hasAndBelongsToMany = array(
		'Permissao' => array(
			'className' => 'Permissao',
			'joinTable' => 'groups_permissoes',
			'foreignKey' => 'group_id',
			'associationForeignKey' => 'permissao_id',
			'unique' => true,
			'conditions' => 'Permissao.ativo = true',
			'fields' => '',
			'order' => 'Permissao.descricao ASC',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
        );

}
?>