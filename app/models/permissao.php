<?php
class Permissao extends AppModel {

	var $name = 'Permissao';
	var $validate = array(
		'nome' => array('notempty'),
		'descricao' => array('notempty'),
		'ativo' => array('notempty')
	);
        var $displayField = 'descricao';
        var $order = 'descricao ASC';
//        var $actsAs   = array('Containable');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
		'Group' => array(
			'className' => 'Group',
			'joinTable' => 'groups_permissoes',
			'foreignKey' => 'permissao_id',
			'associationForeignKey' => 'group_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>