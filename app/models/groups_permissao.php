<?php
class GroupsPermissao extends AppModel {

	var $name = 'GroupsPermissao';
	var $validate = array(
		'group_id' => array('notempty'),
		'permissao_id' => array('numeric')
	);

}
?>