<?php 
/* SVN FILE: $Id$ */
/* Group Fixture generated on: 2010-07-31 16:19:57 : 1280603997*/

class GroupFixture extends CakeTestFixture {
	var $name = 'Group';
	var $table = 'groups';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'length' => 50),
		'created' => array('type'=>'date', 'null' => false),
		'modified' => array('type'=>'date', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'name'  => 'Lorem ipsum dolor sit amet',
		'created'  => '2010-07-31',
		'modified'  => '2010-07-31'
	));
}
?>