<?php
class BloquetosController extends AppController {

	var $name = 'Bloquetos';
	var $helpers = array('Html', 'Form', 'Jquery');

	function index() {
		$this->Bloqueto->recursive = 0;
		$this->set('bloquetos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Bloqueto inválido.', true));
                        $this->redirect(array('action'=>'index'));
		}
		$this->set('bloqueto', $this->Bloqueto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Bloqueto->create();
			if ($this->Bloqueto->save($this->data)) {
                            $this->Session->setFlash(__('O Bloqueto foi salvo com sucesso.', true));
			} else {
                            $this->Session->setFlash(__('O Bloqueto não pôde ser salvo. Por favor, tente novamente.', true));
			}
                        $this->redirect(array('action'=>'index'));
		}
		$bancos = $this->Bloqueto->Banco->find('list');
                $tipos = array('CR'=>'COBRANÇA REGISTRADA', 'CNR'=>'COBRANÇA NÃO REGISTRADA');
		$this->set(compact('bancos','tipos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
                    $this->Session->setFlash(__('Bloqueto inválido.', true));
                    $this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Bloqueto->save($this->data)) {
                                $this->Session->setFlash(__('O Bloqueto foi salvo com sucesso.', true));
			} else {
                            $this->Session->setFlash(__('O Bloqueto não pôde ser salvo. Por favor, tente novamente.', true));
			}
                        $this->redirect(array('action'=>'index'));
		}
		if (empty($this->data)) {
			$this->data = $this->Bloqueto->read(null, $id);
		}
		$bancos = $this->Bloqueto->Banco->find('list');
		$tipos = array('CR'=>'COBRANÇA REGISTRADA', 'CNR'=>'COBRANÇA NÃO REGISTRADA');
		$this->set(compact('bancos','tipos'));
	}

}
?>