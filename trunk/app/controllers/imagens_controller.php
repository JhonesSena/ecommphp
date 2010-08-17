<?php
class ImagensController extends AppController {

	var $name = 'Imagens';
	var $helpers = array('Html', 'Form');
        var $actsAs   = array('transaction', 'Log', 'Containable');
        var $transactional = true;

        
}
?>
