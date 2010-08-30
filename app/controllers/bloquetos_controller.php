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
			$this->flash(__('Bloqueto inválido', true), array('action'=>'index'));
		}
		$this->set('bloqueto', $this->Bloqueto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Bloqueto->create();
			if ($this->Bloqueto->save($this->data)) {
				$this->flash(__('O Bloqueto foi salvo com sucesso.', true), array('action'=>'index'));
			} else {
			}
		}
		$bancos = $this->Bloqueto->Banco->find('list');
                $tipos = array('CR'=>'COBRANÇA REGISTRADA', 'CNR'=>'COBRANÇA NÃO REGISTRADA');
		$this->set(compact('bancos','tipos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Bloqueto inválido', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Bloqueto->save($this->data)) {
				$this->flash(__('O Bloqueto foi salvo com sucesso.', true), array('action'=>'index'));
			} else {
			}
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