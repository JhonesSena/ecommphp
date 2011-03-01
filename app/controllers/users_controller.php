<?php
class UsersController extends AppController {

    var $name = 'Users';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $uses = array('User', 'Cliente','Permissao', 'Group');

    function index() {
        $this->User->recursive = 0;
        $userSession = $this->Session->read('Usuario');
        if($userSession['Group']['name']=='Administrador')
            $this->set('users', $this->paginate(array('User.ativo'=>true,'User.ativo'=>true,'not'=>array('User.group_id'=>null))));
        else
            $this->set('users', $this->paginate(array('User.ativo'=>true, 'User.id'=>$userSession['User']['id'], 'User.ativo'=>true,'not'=>array('User.group_id'=>null))));
    }

    function add() {
            if (!empty($this->data)) {
                    $this->User->create();
                    $dados = $this->data;
                    $dados['Cliente']['email'] = $dados['User']['username'];
                    $dados['User']['password'] = sha1($dados['User']['password']);
                    $dados['User']['autenticacao'] = sha1($dados['User']['username'].date('dmYhi'));
                    if ($this->User->saveAll($dados,array('atomic'=>true))) {
                        $this->Session->setFlash(__('O Usuário foi salvo com sucesso.', true));
                    } else {
                        $db_error = $this->User->getError();
                        if($db_error){
                            $this->Session->setFlash(__($db_error, true));
                        }else{
                            $this->Session->setFlash(__('O Usuário não pôde ser salvo. Por favor, tente novamente.', true));
                        }
                    }
                    $this->redirect(array('action'=>'index'));
            }

            $groups = $this->User->Group->find('list');
            $this->set(compact('groups'));
    }

    function beforeFilter () {
        // executa o beforeFilter do AppController
        $this->Allow('login');
        $this->Allow('edit');
        $this->Allow('logout');
        parent::beforeFilter();
    }

    function login() {
        if(!empty($this->data)){
            if(isset($this->data['User']['username'])){
                $dados = $this->data;
                $dados['User']['password'] = sha1($dados['User']['password']);
                $usuario = $this->User->find('first', array('conditions'=>array('User.username'=>$dados['User']['username'],'User.password'=>$dados['User']['password'])));
                if(!empty($usuario)){
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
                            $telas['pages/view'] = true;
                        }
                        $this->Session->write('UserTelas',$telas);
                    }
                    $this->Session->write('Usuario',$usuario);
                    $this->redirect('/pages/index');
                }else{
                    $this->Session->setFlash(__('Login inválido.', true));
                }
            }
        }
    }

    function logout() {
        $this->Session->delete('Usuario');
        $this->Session->delete('carrinho');
        $this->Session->delete('UserTelas');
//        $this->Auth->logout();
        $this->redirect(array('controller'=>'produtos','action'=>'consultar',1));
//        print_r($this->Auth);
    }

    function edit($hash = null){
        if($hash){
            if($this->data){
                $user = $this->User->find('first', array('conditions'=>array('User.autenticacao'=>$this->data['User']['autenticacao'])));
                $this->data['User']['id'] = $user['User']['id'];
                unset($this->data['User']['redigite_senha']);
                $dados = $this->data;
                $dados['User']['password'] = sha1($dados['User']['password']);
                $dados['User']['autenticacao'] = sha1($dados['User']['username'].date('dmYhi'));
                if($this->User->saveAll($dados, array('atomic'=>true))){
                    $this->Session->setFlash(__('A senha foi redefinida com sucesso.', true));
                    $this->redirect(array('controller'=>'users','action'=>'login'));
                }
                else{
                    $this->Session->setFlash(__('A senha não pôde ser redefinida. Por favor, tente novamente.', true));
                }
            }
            else
                $this->data = $this->Cliente->find('first', array('conditions'=>array('User.autenticacao'=>$hash)));
        }
        else{
            if($this->data){
                $cliente = $this->Cliente->find('first', array('conditions'=>array('Cliente.email'=>$this->data['User']['username'])));
                if(!empty($cliente)){
                    $linkAuth = 'http://'.env('HTTP_HOST').$this->webroot."users/edit/".$cliente['User']['autenticacao'];
                    $nameFrom = 'Bocazul';
                    $from = 'smtp.envio@ig.com.br';
                    $nameTo = $cliente['Cliente']['nome'];
                    $to = $cliente['Cliente']['email'];
                    $subject = 'Redefinição de senha';
                    $msg = "Olá $nameTo! <p> Alguém, provavelmente você, fez um pedido de recuperação de senha da conta Bocazul.
                        Por favor use o URL a seguir para concluir a recuperação de senha. Você será redirecionado para uma página
                        pedindo seu endereco de email e a nova senha.
                        <br><a href='$linkAuth'>$linkAuth</a>";
                    if($this->enviarEmail($nameFrom, $from, $subject, $msg, $to, $nameTo)){
                        $this->Session->setFlash(__('O link de redefinição de senha, foi enviado para seu email.', true));
                    }else{
                        $this->Session->setFlash(__('Ocorreu um erro na recuperação da senha. Por favor tente novamente.', true));
                    }
                }else{
                    $this->Session->setFlash(__('Não existe registro com o email informado, no nosso banco de dados.', true));
                }
                $this->redirect(array('action'=>'login'));
            }
        }
    }

    function edit_user($id = null) {
                $userSession = $this->Session->read('Usuario');
                if($userSession['Group']['name']!='Administrador' && $id != $userSession['User']['id']){
                    //Caso o usuário não seja um administrador, verifica se o id pode ser editado
                    $this->Session->setFlash(__('Usuário inválido.', true));
                    $this->redirect(array('action'=>'index'));
                }

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Usuário inválido.', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
                        $dados = $this->data;
                        if($dados['User']['password']==''){
                            unset($dados['User']['password']);
                            unset($dados['User']['redigite_senha']);
                        }else{
                            $dados['User']['password'] = sha1($dados['User']['password']);
                        }
                        $dados['User']['autenticacao'] = sha1($dados['User']['username'].date('dmYhi'));
			if ($this->User->saveAll($dados, array('atomic'=>true))) {
				$this->Session->setFlash(__('O Usuário foi salvo com sucesso!', true));
				$this->redirect(array('action'=>'index'));
			} else {
                            $db_error = $this->User->getError();
                            if($db_error){
                                $this->Session->setFlash(__($db_error, true));
                            }else{
                                $this->Session->setFlash(__('O Usuário não pôde ser salvo. Por favor, tente novamente.', true));
                            }
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
                $groups = $this->Group->find('list');
                $this->set(compact('groups'));
	}
}
?>