<?php
class SituacaoPedidosController extends AppController {

	var $name = 'SituacaoPedidos';
	var $helpers = array('Html', 'Form', 'Jquery');

	function index() {
		$this->SituacaoPedido->recursive = 0;
		$this->set('situacaoPedidos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Situacao de Pedido inválido.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('situacaoPedido', $this->SituacaoPedido->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SituacaoPedido->create();
			if ($this->SituacaoPedido->save($this->data)) {
				$this->Session->setFlash(__('A Situacao de Pedido foi salva com sucesso', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('A Situação de Pedido não pôde ser salva. Por favor, tente novamente.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Situacao de Pedido inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->SituacaoPedido->save($this->data)) {
				$this->Session->setFlash(__('A Situacao de Pedido foi salva com sucesso', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('A Situação de Pedido não pôde ser salva. Por favor, tente novamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SituacaoPedido->read(null, $id);
		}
	}

}
?>