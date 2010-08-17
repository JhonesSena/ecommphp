<?php
App::import('Vendor', 'FirePHP', array('file' => 'FirePHP' . DS . 'FirePHP.class.php')); 
class FirephpComponent {
	private $instance;
        
	public function __construct() {
		ob_start();
        $this->instance = FirePHP::getInstance(true);
    }
        
    public function __call($name, $args) {
    	call_user_func_array(array($this->instance, $name), $args);
    }
}
?>