<?php
class ClientePedidosController extends AppController {

	var $name = 'ClientePedidos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->ClientePedido->recursive = 0;
		$this->set('clientePedidos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ClientePedido.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('clientePedido', $this->ClientePedido->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ClientePedido->create();
			if ($this->ClientePedido->save($this->data)) {
				$this->Session->setFlash(__('The ClientePedido has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ClientePedido could not be saved. Please, try again.', true));
			}
		}
		$clientes = $this->ClientePedido->Cliente->find('list');
		$pedidos = $this->ClientePedido->Pedido->find('list');
		$this->set(compact('clientes', 'pedidos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ClientePedido', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->ClientePedido->save($this->data)) {
				$this->Session->setFlash(__('The ClientePedido has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ClientePedido could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ClientePedido->read(null, $id);
		}
		$clientes = $this->ClientePedido->Cliente->find('list');
		$pedidos = $this->ClientePedido->Pedido->find('list');
		$this->set(compact('clientes','pedidos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ClientePedido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ClientePedido->del($id)) {
			$this->Session->setFlash(__('ClientePedido deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>