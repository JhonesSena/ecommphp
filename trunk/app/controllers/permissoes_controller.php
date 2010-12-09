<?php
class PermissoesController extends AppController {

	var $name = 'Permissoes';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Permissao->recursive = 0;
		$this->set('permissoes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Permissão inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('permissao', $this->Permissao->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Permissao->create();
			if ($this->Permissao->save($this->data)) {
				$this->Session->setFlash(__('A Permissão foi salva com sucesso!', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('A Permissão não pôde ser salva. Por favor, tente novamente.', true));
			}
		}
		$groups = $this->Permissao->Group->find('list');
		$this->set(compact('groups'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Permissão inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Permissao->save($this->data)) {
				$this->Session->setFlash(__('A Permissão foi salva com sucesso!', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('A Permissão não pôde ser salva. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Permissao->read(null, $id);
		}
		$groups = $this->Permissao->Group->find('list');
		$this->set(compact('groups'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id da Permissão inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Permissao->del($id)) {
			$this->Session->setFlash(__('Permissão excluida com sucesso!', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>