<?php
class ReceitasController extends AppController {

	var $name = 'Receitas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Receita->recursive = 0;
		$this->set('receitas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Receita.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('receita', $this->Receita->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Receita->create();
			if ($this->Receita->save($this->data)) {
				$this->Session->setFlash(__('The Receita has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Receita could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Receita', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Receita->save($this->data)) {
				$this->Session->setFlash(__('The Receita has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Receita could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Receita->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Receita', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Receita->del($id)) {
			$this->Session->setFlash(__('Receita deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>