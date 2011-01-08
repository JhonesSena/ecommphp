<?php
class MateriaisController extends AppController {

	var $name = 'Materiais';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Material->recursive = 0;
		$this->set('materiais', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Material.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('material', $this->Material->read(null, $id));
	}

	function add($receitaId) {
                if(empty ($receitaId)){
                    $this->Session->setFlash(__('Id de Receita inválido.', true));
                    $this->redirect(array('controller'=>'receitas','action' => 'index'));
                }
		if (!empty($this->data)) {
                    $this->data['Material']['receita_id'] = $receitaId;
			$this->Material->create();
			if ($this->Material->save($this->data)) {
				$this->Session->setFlash(__('O Material foi salvo com sucesso!', true));
				$this->redirect(array('controller'=>'receitas','action' => 'edit',"$receitaId#tab3"));
			} else {
				$this->Session->setFlash(__('O Material não pôde ser salvo. Por favor, tente novamente.', true));
			}
		}
                $this->redirect(array('controller'=>'receitas','action' => 'edit',"$receitaId#tab3"));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Material', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Material->save($this->data)) {
				$this->Session->setFlash(__('The Material has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Material could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Material->read(null, $id);
		}
		$receitas = $this->Material->Receita->find('list');
		$this->set(compact('receitas'));
	}

	function delete($id = null, $receitaId = null) {
		if (!$id || !$receitaId) {
			$this->Session->setFlash(__('Id de Receita inválido', true));
			$this->redirect(array('controller'=>'receitas','action'=>'index'));
		}
		if ($this->Material->del($id)) {
			$this->Session->setFlash(__('Material excluido com sucesso!', true));
			$this->redirect(array('controller'=>'receitas','action' => 'edit',"$receitaId#tab3"));
		}
	}

}
?>