<?php
class CedentesController extends AppController {

    var $name = 'Cedentes';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $uses = array('Cedente','Cliente', 'PessoaFisica', 'PessoaJuridica');

    function index() {
        $this->Cedente->recursive = 1;
        $this->set('cedentes', $this->paginate());
    }

    function view($id = null) {
        $options = array();
        $options['conditions'] = array('Cedente.id'=>$id);
        $options['fields'] = array('Cedente.id', 'Cedente.conta_corrente','Cedente.agencia_id', 'Cedente.bloqueto_id',
                'Cliente.id','Cliente.telefone', 'Cliente.email', 'Cliente.logradouro',
                'Cliente.cep', 'Cliente.bairro', 'Cliente.cidade', 'Cliente.nome', 'Cliente.estado_id', 'Cliente.ativo',
                'PessoaFisica.id','PessoaFisica.cpf', 'PessoaJuridica.id', 'PessoaJuridica.cnpj', 'PessoaJuridica.nome_fantasia',
                'Agencia.codigo', 'Bloqueto.carteira');
        $options['joins'] = array(
                array(
                        'table' => 'clientes',
                        'alias' => 'Cliente',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'Cedente.cliente_id = Cliente.id',
                        )
                ),
                array('table' => 'pessoa_fisicas',
                        'alias' => 'PessoaFisica',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'PessoaFisica.cliente_id = Cliente.id',
                        )
                ),
                array('table' => 'pessoa_juridicas',
                        'alias' => 'PessoaJuridica',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'PessoaJuridica.cliente_id = Cliente.id',
                        )
                ),
                array('table' => 'agencias',
                        'alias' => 'Agencia',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'Cedente.agencia_id = Agencia.id',
                        )
                ),
                array('table' => 'bloquetos',
                        'alias' => 'Bloqueto',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'Cedente.bloqueto_id = Bloqueto.id',
                        )
                )
        );
        if (!$id) {

            $this->Session->setFlash(__('Cedente inválido.', true));
            $this->redirect(array('action'=>'index'));
        }
        $estados = $this->Cedente->Cliente->Estado->find('list');
        $this->Cedente->recursive = -1;
        $cedente = $this->Cedente->find('first', $options);
        $this->set(compact('cedente', 'estados'));
    }

    function add() {
        if (!empty($this->data)) {
            if($this->data['Cliente']['tipo_pessoa']=='f') {
                unset($this->data['PessoaJuridica']);
            }
            if($this->data['Cliente']['tipo_pessoa']=='j') {
                unset($this->data['PessoaFisica']);
            }
//                        print_r($this->data);exit;
            $this->Cedente->begin();
            $this->Cedente->create();
            if($this->Cliente->save($this->data)) {
                $idCliente = $this->Cedente->Cliente->id;
                $this->data['Cedente']['cliente_id'] = $idCliente;
                if ($this->Cedente->save($this->data)) {
                    if($this->data['Cliente']['tipo_pessoa']=='f') {
                        $this->data['PessoaFisica']['cliente_id'] = $idCliente;
                        if ($this->PessoaFisica->save($this->data)) {
                            $this->Cedente->commit();
                        }
                    }
                    else {
                        $this->data['PessoaJuridica']['cliente_id'] = $idCliente;
                        if ($this->PessoaJuridica->save($this->data)) {
                            $this->Cedente->commit();
                        }
                    }
                    $this->Session->setFlash(__('O Cedente foi salvo com sucesso!', true));
                    $this->redirect(array('action'=>'index'));


                } else {
                    $this->Cedente->rollback();
                    $this->Session->setFlash(__('O Cedente não pôde ser salvo. Por favor, tente novamente.', true));
                }
            } else {
                $this->Cedente->rollback();
                $this->Session->setFlash(__('O Cedente não pôde ser salvo. Por favor, tente novamente.', true));
            }
        }
        $bloquetos = $this->Cedente->Agencia->Banco->Bloqueto->find('list');
        $agencias = $this->Cedente->Agencia->find('list');
        $estados = $this->Cedente->Cliente->Estado->find('list');
        $tipoCliente = array('f'=>'Pessoa Física', 'j'=>'Pessoa Jurídica');
        $this->set(compact('estados', 'tipoCliente', 'agencias', 'bloquetos'));
    }

    function edit($id = null) {
        $options = array();
        $options['conditions'] = array('Cedente.id'=>$id);
        $options['fields'] = array('Cedente.id', 'Cedente.conta_corrente','Cedente.agencia_id', 'Cedente.bloqueto_id',
                'Cliente.id','Cliente.telefone', 'Cliente.email', 'Cliente.logradouro',
                'Cliente.cep', 'Cliente.bairro', 'Cliente.cidade', 'Cliente.nome', 'Cliente.estado_id', 'Cliente.ativo',
                'PessoaFisica.id','PessoaFisica.cpf', 'PessoaJuridica.id', 'PessoaJuridica.cnpj', 'PessoaJuridica.nome_fantasia');
        $options['joins'] = array(
                array(
                        'table' => 'clientes',
                        'alias' => 'Cliente',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'Cedente.cliente_id = Cliente.id',
                        )
                ),
                array('table' => 'pessoa_fisicas',
                        'alias' => 'PessoaFisica',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'PessoaFisica.cliente_id = Cliente.id',
                        )
                ),
                array('table' => 'pessoa_juridicas',
                        'alias' => 'PessoaJuridica',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'PessoaJuridica.cliente_id = Cliente.id',
                        )
                ),
                array('table' => 'agencias',
                        'alias' => 'Agencia',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'Cedente.agencia_id = Agencia.id',
                        )
                ),
                array('table' => 'bloquetos',
                        'alias' => 'Bloqueto',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'Cedente.bloqueto_id = Bloqueto.id',
                        )
                )
        );
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Cedente inválido', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {

            if($this->data['Cliente']['tipo_pessoa']=='f') {
                unset($this->data['PessoaJuridica']);
            }
            if($this->data['Cliente']['tipo_pessoa']=='j') {
                unset($this->data['PessoaFisica']);
            }

            $this->Cedente->recursive = -1;
            $cedente = $this->Cedente->find('first', $options);

            $this->Cedente->begin();
            $salvar = true;

            if((!empty($cedente['PessoaFisica']['id']) && isset($this->data['PessoaJuridica']))) {
                if($this->Cedente->Cliente->PessoaFisica->del($cedente['PessoaFisica']['id'])==false)
                    $salvar = false;
            }
            if((!empty($cedente['PessoaJuridica']['id']) && isset($this->data['PessoaFisica']))) {
                if($this->Cedente->Cliente->PessoaJuridica->del($cedente['PessoaJuridica']['id'])==false)
                    $salvar = false;
            }

            if($this->Cliente->save($this->data) && $salvar) {
                $idCliente = $this->Cedente->Cliente->id;
                $this->data['Cedente']['cliente_id'] = $idCliente;
                if ($this->Cedente->save($this->data)) {
                    if($this->data['Cliente']['tipo_pessoa']=='f') {
                        $this->data['PessoaFisica']['cliente_id'] = $idCliente;
                        if ($this->PessoaFisica->save($this->data)) {
                            $this->Cedente->commit();
                        }
                    }
                    else {
                        $this->data['PessoaJuridica']['cliente_id'] = $idCliente;
                        if ($this->PessoaJuridica->save($this->data)) {
                            $this->Cedente->commit();
                        }
                    }
                    $this->Session->setFlash(__('O Cedente foi salvo com sucesso!', true));
                    $this->redirect(array('action'=>'index'));


                } else {
                    $this->Cedente->rollback();
                    $this->Session->setFlash(__('O Cedente não pôde ser salvo. Por favor, tente novamente.', true));
                }
            } else {
                $this->Cedente->rollback();
                $this->Session->setFlash(__('O Cedente não pôde ser salvo. Por favor, tente novamente.', true));
            }
        }
        $tipo = 'f';
        if (empty($this->data)) {

            $this->Cedente->recursive = -1;
            $this->data = $this->Cedente->find('first', $options);
            if(!empty($this->data['PessoaFisica']['id']))
                $tipoPessoa = 'f';
            else
                $tipoPessoa = 'j';
        }
        $bloquetos = $this->Cedente->Agencia->Banco->Bloqueto->find('list');
        $agencias = $this->Cedente->Agencia->find('list');
        $estados = $this->Cedente->Cliente->Estado->find('list');

        $tipoCliente = array('f'=>'Pessoa Física', 'j'=>'Pessoa Jurídica');
        $this->set(compact('estados', 'tipoCliente', 'agencias', 'bloquetos', 'tipoPessoa'));
    }
}
?>