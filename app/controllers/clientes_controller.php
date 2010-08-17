<?php
class ClientesController extends AppController {

	var $name = 'Clientes';
	var $helpers = array('Html', 'Form', 'Jquery');

	function index() {
		$this->Cliente->recursive = 0;
		$this->set('clientes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Cliente.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('cliente', $this->Cliente->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash(__('The Cliente has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Cliente could not be saved. Please, try again.', true));
			}
		}
		$estados = $this->Cliente->Estado->find('list');
		$this->set(compact('estados'));
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
		$grupoAcessos = $this->Cliente->GrupoAcesso->find('list');
		$this->set(compact('estados','grupoAcessos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Cliente', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cliente->del($id)) {
			$this->Session->setFlash(__('Cliente deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>