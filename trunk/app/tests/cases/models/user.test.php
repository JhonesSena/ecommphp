<?php 
/* SVN FILE: $Id$ */
/* User Test cases generated on: 2010-07-31 16:21:44 : 1280604104*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $User = null;
	var $fixtures = array('app.user', 'app.group', 'app.cliente');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function testUserInstance() {
		$this->assertTrue(is_a($this->User, 'User'));
	}

	function testUserFind() {
		$this->User->recursive = -1;
		$results = $this->User->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('User' => array(
			'id'  => 1,
			'password'  => 'Lorem ipsum dolor sit amet',
			'group_id'  => 1,
			'username'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2010-07-31',
			'modified'  => '2010-07-31'
		));
		$this->assertEqual($results, $expected);
	}
}
?>