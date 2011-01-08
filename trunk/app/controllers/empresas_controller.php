<?php
class EmpresasController extends AppController {

	var $name = 'Empresas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Empresa->recursive = 0;
		$this->set('empresas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Empresa inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('empresa', $this->Empresa->read(null, $id));
	}

	function add() {
            $empresa = $this->Empresa->find('first');
            if(!empty($empresa)){
                $this->redirect(array('action'=>'index'));
            }
		if (!empty($this->data)) {
			$this->Empresa->create();
			if ($this->Empresa->save($this->data)) {
				$this->Session->setFlash(__('A Empresa foi salva com sucesso!', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('A Empresa não pôde ser salva. Por favor, tente novamente', true));
			}
		}
		$estados = $this->Empresa->Estado->find('list');
		$this->set(compact('estados'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Empresa inválida', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Empresa->save($this->data)) {
				$this->Session->setFlash(__('A Empresa foi salva com sucesso!', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('A Empresa não pôde ser salva. Por favor, tente novamente', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Empresa->read(null, $id);
		}
		$estados = $this->Empresa->Estado->find('list');
		$this->set(compact('estados'));
	}
}
?>