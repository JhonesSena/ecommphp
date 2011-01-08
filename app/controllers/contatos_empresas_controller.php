<?php
class ContatosEmpresasController extends AppController {

	var $name = 'ContatosEmpresas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->ContatosEmpresa->recursive = 0;
		$this->set('contatosEmpresas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Contato inválido.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('contatosEmpresa', $this->ContatosEmpresa->read(null, $id));
	}

	function add($empresaId = null) {
            if(empty ($empresaId)){
                $this->redirect(array('controller'=>'empresas','action'=>'index'));
            }
		if (!empty($this->data)) {
                    $this->data['ContatosEmpresa']['empresa_id'] = $empresaId;
			$this->ContatosEmpresa->create();
			if ($this->ContatosEmpresa->save($this->data)) {
				$this->Session->setFlash(__('O Contato foi salvo com sucesso!', true));
				$this->redirect(array('controller'=>'empresas','action'=>'edit',"$empresaId#tab2"));
			} else {
				$this->Session->setFlash(__('O Contato não pôde ser salvo. Por favor, tente novamente.', true));
			}
		}
		$empresas = $this->ContatosEmpresa->Empresa->find('list');
		$this->set(compact('empresas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Contato inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->ContatosEmpresa->save($this->data)) {
				$this->Session->setFlash(__('O Contato foi salvo com sucesso!', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('O Contato não pôde ser salvo. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ContatosEmpresa->read(null, $id);
		}
		$empresas = $this->ContatosEmpresa->Empresa->find('list');
		$this->set(compact('empresas'));
	}

	function delete($id = null, $empresaId = null) {
		if (!$id || !$empresaId) {
			$this->Session->setFlash(__('Contato Inválido', true));
			$this->redirect(array('cnontroller'=>'empresas','action'=>'index'));
		}
		if ($this->ContatosEmpresa->del($id)) {
			$this->Session->setFlash(__('Contato excluido com sucesso!', true));
			$this->redirect(array('controller'=>'empresas','action'=>'edit',"$empresaId#tab2"));
		}
	}

}
?>