<?php
class AgenciasController extends AppController {

	var $name = 'Agencias';
	var $helpers = array('Html', 'Form', 'Jquery');

        function add() {
		if (!empty($this->data)) {
			$this->Agencia->create();
			if ($this->Agencia->save($this->data)) {
                            $this->Session->setFlash(__('A Agencia foi salva com sucesso.', true));
			} else {
                            $this->Session->setFlash(__('A Agencia não pôde ser salva. Por favor, tente novamente.', true));
			}
                        $this->redirect(array('action'=>'index'));
		}
		$bancos = $this->Agencia->Banco->find('list');
                $estados = $this->Agencia->Estado->find('list');
		$this->set(compact('bancos','estados'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
                    $this->Session->setFlash(__('Agencia inválido.', true));
                    $this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Agencia->save($this->data)) {
                                $this->Session->setFlash(__('O Agencia foi salvo com sucesso.', true));
			} else {
                            $this->Session->setFlash(__('O Agencia não pôde ser salvo. Por favor, tente novamente.', true));
			}
                        $this->redirect(array('action'=>'index'));
		}
		if (empty($this->data)) {
			$this->data = $this->Agencia->read(null, $id);
		}
		$bancos = $this->Agencia->Banco->find('list');
		$estados = $this->Agencia->Estado->find('list');
		$this->set(compact('bancos','estados'));
	}
}
?>