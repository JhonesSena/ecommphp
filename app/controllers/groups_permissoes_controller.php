<?php
class GroupsPermissoesController extends AppController {

	var $name = 'GroupsPermissoes';
	var $helpers = array('Html', 'Form', 'Jquery');

	function index() {
		$this->GroupsPermissao->recursive = 0;
		$this->set('groupsPermissoes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Grupo de Acesso.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('groupsPermissao', $this->GroupsPermissao->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->GroupsPermissao->create();
			if ($this->GroupsPermissao->save($this->data)) {
				$this->Session->setFlash(__('The GroupsPermissao has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The GroupsPermissao could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid GroupsPermissao', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->GroupsPermissao->save($this->data)) {
				$this->Session->setFlash(__('The GroupsPermissao has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The GroupsPermissao could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->GroupsPermissao->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for GroupsPermissao', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->GroupsPermissao->del($id)) {
			$this->Session->setFlash(__('GroupsPermissao deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>