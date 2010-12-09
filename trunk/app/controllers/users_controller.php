<?php
class UsersController extends AppController {

    var $name = 'Users';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $uses = array('User', 'Cliente','Permissao');

    function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate(array('User.ativo'=>true, 'User.group_id'=>1)));
    }

    function beforeFilter () {
        // executa o beforeFilter do AppController
        parent::beforeFilter();
        // adicione ao método allow as actions que quer permitir sem o usuário estar logado
        $this->Auth->allow('login');
        $this->Auth->allow('add');
        $this->Auth->allow('edit');
        if(!empty($this->data)){
            if(isset($this->data['User']['username'])){
                $usuario = $this->User->find('first', array('conditions'=>array('User.username'=>$this->data['User']['username'])));
                if(!empty($usuario['Group']['id'])){
                    $joins = array(
                                 array('table' => 'groups_permissoes',
                                 'alias' => 'GroupsPermissao',
                                 'type' => 'LEFT',
                                 'conditions' => array(
                                 'Permissao.id = GroupsPermissao.permissao_id',
                                )
                        ));
                    $permissoes = $this->Permissao->find('list',array('joins'=>$joins,'fields'=>array('Permissao.nome'),'conditions'=>array('GroupsPermissao.group_id'=>$usuario['Group']['id'])));

                    $telas = array();
                    if(!empty($permissoes)){
                        foreach ($permissoes as $permissao) {
                            $telas[$permissao] = true;
                        }
                        $telas['users/login'] = true;
                        $telas['users/logout'] = true;
                    }
                    $this->Session->write('UserTelas',$telas);
                }
                $this->Session->write('Usuario',$usuario);               
            }
        }
    }

    function login() {
//        print_r($this->Auth);
//        if($this->data);exit;
    }

    function logout() {
        $this->Session->delete('Usuario');
        $this->Session->delete('carrinho');
        $this->Session->delete('UserTelas');
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

    function edit_user($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Usuário inválido.', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('O Usuário foi salvo com sucesso!', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('O Usuário não pôde ser salvo. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}
}
?>