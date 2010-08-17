<?php
class UsersController extends AppController {

    var $name = 'Users';
    var $helpers = array('Html', 'Form', 'Jquery');

    function beforeFilter () {
        // executa o beforeFilter do AppController
        parent::beforeFilter();
        // adicione ao método allow as actions que quer permitir sem o usuário estar logado
        $this->Auth->allow('login');
        $this->Auth->allow('add');
//        print_r($this->Auth);
    }

    function login() {
//        print_r($this->Auth);
    }

    function logout() {
        $this->Auth->logout();
        $this->redirect(array('action'=>'login'));
//        print_r($this->Auth);
    }
}
?>