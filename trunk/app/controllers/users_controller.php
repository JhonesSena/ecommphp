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
        $this->Auth->allow('edit');
        if(!empty($this->data)){
            if(isset($this->data['User']['username'])){
                $usuario = $this->Cliente->find('first', array('conditions'=>array('Cliente.email'=>$this->data['User']['username'])));
                $this->Session->write('Cliente',$usuario);
            }
        }
//        print_r($this->Auth);
    }

    function login() {
//        print_r($this->Auth);
//        if($this->data);exit;
    }

    function logout() {
        $this->Session->delete('Cliente');
        $this->Auth->logout();
        $this->redirect(array('action'=>'login'));
//        print_r($this->Auth);
    }

    function edit($hash = null){
        if($hash){
            if($this->data){
                $user = $this->User->find('first', array('conditions'=>array('User.autenticacao'=>$this->data['User']['autenticacao'])));
                $this->data['User']['id'] = $user['User']['id'];
                unset($this->data['User']['redigite_senha']);
                if($this->User->save($this->data)){
                    $this->Session->setFlash(__('A senha foi redefinida com sucesso.', true));
                    $this->redirect(array('controller'=>'shopps','action'=>'index'));
                }
                else
                    $this->Session->setFlash(__('A senha não pôde ser redefinida. Por favor, tente novamente.', true));
            }
            else
                $this->data = $this->Cliente->find('first', array('conditions'=>array('User.autenticacao'=>$hash)));
//            $this->data['User']['password'] = null;
//            print_r($this->data);
        }
        else{
            if($this->data){
                $cliente = $this->Cliente->find('first', array('Cliente.email'=>$this->data['User']['username']));
                $linkAuth = 'http://'.$this->Auth->Session->host.$this->webroot."users/edit/".$cliente['User']['autenticacao'];
                $nameFrom = 'Bocazul';
                $from = 'smtp.envio@ig.com.br';
                $nameTo = $cliente['Cliente']['nome'];
                $to = $cliente['Cliente']['email'];
                $subject = 'Redefinição de senha';
                $msg = "Olá $nameTo! <p> Alguém, provavelmente você, fez um pedido de recuperação de senha da conta Bocazul.
                    Por favor use o URL a seguir para concluir a recuperação de senha. Você será enviado para uma página
                    pedindo seu endereco de email e a nova senha.
                    <br><a href='$linkAuth'>$linkAuth</a>";
                if($this->enviarEmail($nameFrom, $from, $subject, $msg, $to, $nameTo))
                    $this->Session->setFlash(__('O link de redefinição de senha, foi enviado para seu email.', true));
                else
                    $this->Session->setFlash(__('Ocorreu um erro na recuperação da senha. Por favor tente novamente.', true));
                $this->redirect(array('controller'=>'users','action'=>'login'));
            }
        }
    }
}
?>