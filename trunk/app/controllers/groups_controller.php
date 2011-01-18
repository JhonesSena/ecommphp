<?php
class GroupsController extends AppController {

    var $name = 'Groups';
    var $helpers = array('Html', 'Form', 'Jquery');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allowedActions = array('*');
    }
    
    function index($inativo = 'off', $nome = '') {
        $this->Group->recursive = 0;
        if(!empty($this->data))
        {
            $inativo = $this->data[$this->Model->name]['inativo'];
            $nome = $this->data[$this->Model->name]['nome'];
        }
        if ($inativo == 'on') {
            $retorno = $this->paginate(array('upper(Group.name) like' => '%'.mb_strtoupper($nome,"utf-8").'%', 'Group.ativo'=>false));
            $parametro = array('inativo'=>'on','nome'=>$nome);
        }
        else if ($inativo == 'off') {
            $retorno = $this->paginate(array('upper(Group.name) like' => '%'.mb_strtoupper($nome,"utf-8").'%','Group.ativo'=>true));
            $parametro = array('inativo'=>'off','nome'=>$nome);
        }else {
            $retorno = $this->paginate(array('upper(Group.name) like' => '%'.mb_strtoupper($nome,"utf-8").'%'));
            $parametro = array('inativo'=>'all','nome'=>$nome);
        }
        $this->set('groups',$retorno);
        $this->set('parametro',$parametro);
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Grupo de Acesso Inválido.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('group', $this->Group->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Group->create();
            if ($this->Group->save($this->data)) {
                $this->Session->setFlash(__('O Grupo de Acesso foi salvo com sucesso!', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('O Grupo de Acesso não pôde ser salvo. Por favor, tente novamente.', true));
            }
        }

        $permissoes = $this->Group->Permissao->find('list');
        $this->set(compact('permissoes'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Grupo de Acesso Inválido', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Group->save($this->data)) {
                $this->Session->setFlash(__('O Grupo de Acesso foi salvo com sucesso!', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('O Grupo de Acesso não pôde ser salvo. Por favor, tente novamente.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Group->read(null, $id);
        }

//        print_r($this->data);exit;
        $permissoes = $this->Group->Permissao->find('list');
        $this->set(compact('permissoes'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Identificador inválido para o Grupo de Acesso.', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Group->del($id)) {
            $this->Session->setFlash(__('Grupo de Acesso excluído com sucesso.', true));
            $this->redirect(array('action'=>'index'));
        }
    }

}
?>