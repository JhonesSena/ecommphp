<?php 
/* SVN FILE: $Id$ */
/* User Fixture generated on: 2010-07-31 16:21:44 : 1280604104*/

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $table = 'users';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
		'password' => array('type'=>'string', 'null' => false, 'length' => 50),
		'group_id' => array('type'=>'integer', 'null' => false),
		'username' => array('type'=>'string', 'null' => false),
		'created' => array('type'=>'date', 'null' => false),
		'modified' => array('type'=>'date', 'null' => false),
		'indexes' => array('PRIMARY' => array('unique' => true, 'column' => 'id'))
	);
	var $records = array(array(
		'id'  => 1,
		'password'  => 'Lorem ipsum dolor sit amet',
		'group_id'  => 1,
		'username'  => 'Lorem ipsum dolor sit amet',
		'created'  => '2010-07-31',
		'modified'  => '2010-07-31'
	));
}
?>