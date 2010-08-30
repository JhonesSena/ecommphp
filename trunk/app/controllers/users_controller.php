<?php
class UsersController extends AppController {

    var $name = 'Users';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $uses = array('User', 'Cliente');

    function beforeFilter () {
        // executa o beforeFilter do AppController
        parent::beforeFilter();
        // adicione ao método allow as actions que quer permitir sem o usuário estar logado
        $this->Auth->allow('login');
        $this->Auth->allow('add');
        if(!empty($this->data)){
            $usuario = $this->Cliente->find('first', array('conditions'=>array('Cliente.email'=>$this->data['User']['username'])));
            $this->Session->write('Cliente',$usuario);
        }
//        print_r($this->Auth);
    }

    function login() {
//        print_r($this->Auth);
    }

    function logout() {
        $this->Session->delete('Cliente');
        $this->Auth->logout();
        $this->redirect(array('action'=>'login'));
//        print_r($this->Auth);
    }
}
?>