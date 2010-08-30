<?php
class ClientesController extends AppController {

    var $name = 'Clientes';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $uses= array('Cliente', 'User');

    function beforeFilter () {
        // executa o beforeFilter do AppController
        parent::beforeFilter();
        // adicione ao método allow as actions que quer permitir sem o usuário estar logado
        $this->Auth->allow('add');
        $this->Auth->allow('edit');
    }
    
    function index() {
        $this->Cliente->recursive = 0;
        $usuarioSession = $this->Session->read('Cliente');
        $this->set('clientes', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Cliente inválido.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('cliente', $this->Cliente->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->data['User']['username'] = $this->data['Cliente']['email'];
            $this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
            $this->data['Cliente']['redigite_senha'] = Security::hash($this->data['Cliente']['redigite_senha'], null, true);
            $this->data['User']['autenticacao'] = Security::hash($this->data['User']['username'], null, true);
            $this->data['User']['ativo'] = false;
            if($this->data['Cliente']['tipo_pessoa']=='f') {
                unset($this->data['PessoaJuridica']);
            }
            if($this->data['Cliente']['tipo_pessoa']=='j') {
                unset($this->data['PessoaFisica']);
            }
            $linkAuth = 'http://'.$this->Auth->Session->host.$this->webroot."clientes/auth/".$this->data['User']['autenticacao'];
            $nameFrom = 'Bocazul';
            $from = 'clezioalves@ig.com.br';
            $nameTo = $this->data['Cliente']['nome'];
            $to = $this->data['Cliente']['email'];
            $subject = 'Confirmação de cadastro';
            $msg = "Bém vindo $nameTo! <p>  Click no link abaixo para confirmar seu
                cadastro no site bocazul.<br><a href='$linkAuth'>$linkAuth</a>";
            
            if($this->data['User']['password'] == $this->data['Cliente']['redigite_senha']) {
                $this->Cliente->create();
                if ($this->Cliente->saveAll($this->data)) {
                    if($this->enviarEmail($nameFrom, $from, $subject, $msg, $to, $nameTo))
                        $this->Session->setFlash(__('O link de confirmação de cadastro, foi enviada para seu email.', true));
                    else
                        $this->Session->setFlash(__('Ocorreu um erro no envio do link de confirmação seu email. Por favor tente novamente.', true));
                    $this->redirect(array('controller'=>'shopps','action'=>'index'));
                } else {
                    $this->data['User']['password'] = '';
                    $this->data['Cliente']['redigite_senha'] = '';
                    $this->Session->setFlash(__('O Cliente não pode ser salvo. Por favor, tente novamente.', true));
                }
            }
            else {
                $this->data['User']['password'] = '';
                $this->data['Cliente']['redigite_senha'] = '';
                $this->Session->setFlash(__('A confimação da senha não coincide.', true));
            }
        }
        $estados = $this->Cliente->Estado->find('list');
        $tipoCliente = array('f'=>'Pessoa Física', 'j'=>'Pessoa Jurídica');
        $this->set(compact('estados', 'tipoCliente'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Cliente', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Cliente->save($this->data)) {
                $this->Session->setFlash(__('The Cliente has been saved', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The Cliente could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Cliente->read(null, $id);
        }
        $estados = $this->Cliente->Estado->find('list');
        $this->set(compact('estados'));
    }

    function auth($hash){
        if($hash){
            $user = $this->User->find('all', array('conditions'=>array('User.autenticacao'=>$hash)));
            if($user){
                $this->data['User']['id'] = $user[0]['User']['id'];
                $this->data['User']['ativo'] = true;
                if($this->User->save($this->data)){
                    $this->Session->setFlash('Confirmação realizada com sucesso.');
                } else {
                    $this->Session->setFlash('A confirmação não pôde ser realizada.');
                }
                

            }
            else{
                $this->Session->setFlash('A confirmação não pôde ser realizada.');
            }
            $this->redirect(array('controller'=>'shopps','action'=>'index'));
        }
    }

}

?>