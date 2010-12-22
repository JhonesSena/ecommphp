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
			$this->Session->setFlash(__('Receita Inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('receita', $this->Receita->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Receita->create();
			if ($this->Receita->save($this->data)) {
				$this->Session->setFlash(__('A Receita foi salva com sucesso.', true));
                                $id = $this->Receita->id;
				$this->redirect(array('action'=>'edit',"$id#tab2"));
			} else {
				$this->Session->setFlash(__('A Receita não pôde er salva. Por favor tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Receita Inválida.', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Receita->save($this->data)) {
				$this->Session->setFlash(__('A Receita foi salva com sucesso.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('A Receita não pôde er salva. Por favor tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Receita->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Identificador de Receita inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Receita->del($id)) {
			$this->Session->setFlash(__('Receita excluida', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>