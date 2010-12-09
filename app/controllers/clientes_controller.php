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
        $this->Auth->allow('auth');
    }

    function index() {
        $this->Cliente->recursive = 0;
        $usuarioSession = $this->Session->read('Usuario');
        $this->set('clientes', $this->paginate(array('Cliente.user_id is NOT NULL')));
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
                $this->Cliente->begin();
                $this->Cliente->create();
                $save = true;
                if($this->Cliente->User->save($this->data)) {
                    $idUser = $this->Cliente->User->id;
                    $this->data['Cliente']['user_id'] = $idUser;
                    if ($this->Cliente->save($this->data)) {
                        if($this->data['Cliente']['tipo_pessoa']=='f') {
                            $this->data['PessoaFisica']['cliente_id'] = $this->Cliente->id;
                            if($this->Cliente->PessoaFisica->save($this->data)==false)
                                $save = false;
                        }
                        else {
                            $this->data['PessoaFisica']['cliente_id'] = $this->Cliente->id;
                            if($this->Cliente->PessoaJuridica->save($this->data)==false)
                                $save = false;
                        }

                        if($save) {
                            if($this->enviarEmail($nameFrom, $from, $subject, $msg, $to, $nameTo))
                                $this->Session->setFlash(__('A confirmação de cadastro, foi enviada para seu email.', true));
                            else {
                                $this->Session->setFlash(__('Ocorreu um erro no envio da confirmação para seu email. Por favor tente novamente.', true));
                                $save = false;
                            }
                        }

                    } else {
                        $save = false;
                    }
                }
                else
                    $save = false;

                if($save) {
                    $this->Cliente->commit();
                    $this->redirect(array('controller'=>'shopps','action'=>'index'));
                }
                else {
                    $this->Cliente->rollback();
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
            $this->Session->setFlash(__('Usuário inválido', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            $senhaOk = true;
            if(!empty($this->data['User']['password'])){
                $this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
                $this->data['Cliente']['redigite_senha'] = Security::hash($this->data['Cliente']['redigite_senha'], null, true);
                if($this->data['User']['password'] != $this->data['Cliente']['redigite_senha']){
                    $senhaOk = false;
                }
            }
            else{
                unset($this->data['User']);
            }
            
            if($senhaOk){
                if($this->data['Cliente']['tipo_pessoa']=='f') {
                    unset($this->data['PessoaJuridica']);
                }
                if($this->data['Cliente']['tipo_pessoa']=='j') {
                    unset($this->data['PessoaFisica']);
                }
                $cliente = $this->Cliente->find('first', array('conditions'=>array('Cliente.id'=>$this->data['Cliente']['id'])));
                $this->Cliente->begin();
                $salvar = true;
                if((!empty($cliente['PessoaFisica']['id']) && isset($this->data['PessoaJuridica']))) {
                    if($this->Cliente->PessoaFisica->del($cliente['PessoaFisica']['id'])==false)
                        $salvar = false;
                }
                if((!empty($cliente['PessoaJuridica']['id']) && isset($this->data['PessoaFisica']))) {
                    if($this->Cliente->PessoaJuridica->del($cliente['PessoaJuridica']['id'])==false)
                        $salvar = false;
                }
                if($salvar){
                    if ($this->Cliente->save($this->data)) {
                        $idCliente = $this->Cliente->id;
                        if($this->data['Cliente']['tipo_pessoa']=='f') {
                            $this->data['PessoaFisica']['cliente_id'] = $idCliente;
                            if ($this->Cliente->PessoaFisica->save($this->data)==false) {
                                $salvar = false;
                            }
                        }
                        else {
                            $this->data['PessoaJuridica']['cliente_id'] = $idCliente;
                            if ($this->Cliente->PessoaJuridica->save($this->data)==false) {
                                $salvar = false;
                            }
                        }

                        if(!empty($this->data['User']['password'])){
                            $this->data['User']['cliente_id'] = $idCliente;
                            if ($this->Cliente->User->save($this->data)==false) {
                                $salvar = false;
                            }
                        }
                        $this->Session->setFlash(__('A alteração foi realizada com sucesso.', true));
                    } else {
                        $this->Session->setFlash(__('A alteração não pôde ser realizada. Por favor, tente novamente.', true));
                    }
                }

                if($salvar){
                    $this->Cliente->commit();
                    $this->redirect(array('action'=>'index'));
                }else{
                    $this->Cliente->rollback();
                }
            }
            else{
                $this->Session->setFlash(__('A confimação da senha não coincide.', true));
            }

        }
        $selectPessoa = 'f';
        if (empty($this->data)) {
            $this->Cliente->unBindModel(array('hasMany' => array('ClientePedido')));
            $this->data = $this->Cliente->read(null, $id);
            if(!empty($this->data['PessoaJuridica']['id']))
                $selectPessoa = 'j';
            if(!empty($this->data['PessoaFisica']['id']))
                $selectPessoa = 'f';
        }
        $estados = $this->Cliente->Estado->find('list');
        $tipoCliente = array('f'=>'Pessoa Física', 'j'=>'Pessoa Jurídica');
        $this->set(compact('estados', 'tipoCliente', 'selectPessoa'));
    }

    function auth($hash) {
        if($hash) {
            $user = $this->User->find('all', array('conditions'=>array('User.autenticacao'=>$hash)));
            if($user) {
                $this->data['User']['id'] = $user[0]['User']['id'];
                $this->data['User']['ativo'] = true;
                if($this->User->save($this->data)) {
                    $this->Session->setFlash('Confirmação realizada com sucesso.');
                } else {
                    $this->Session->setFlash('A confirmação não pôde ser realizada.');
                }


            }
            else {
                $this->Session->setFlash('A confirmação não pôde ser realizada.');
            }
            $this->redirect(array('controller'=>'shopps','action'=>'index'));
        }
    }

}

?>