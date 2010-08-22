<?php
class SituacoesController extends AppController {

	var $name = 'Situacoes';
	var $helpers = array('Html', 'Form', 'Jquery');

	function index() {
		$this->Situacao->recursive = 0;
		$this->set('situacoes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Situação inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('situacao', $this->Situacao->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Situacao->create();
			if ($this->Situacao->save($this->data)) {
				$this->Session->setFlash(__('A Situação foi salva com sucesso.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('A Situação não pôde ser salva. Por favor, tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Situacao inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Situacao->save($this->data)) {
				$this->Session->setFlash(__('A Situação foi salva com sucesso', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('A Situação não pôde ser salva. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Situacao->read(null, $id);
		}
	}

}
?>