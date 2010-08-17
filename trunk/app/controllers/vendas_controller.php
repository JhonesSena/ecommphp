<?php
class VendasController extends AppController {

	var $name = 'Vendas';
	var $helpers = array('Html', 'Form');
        var $uses = array('Venda','Produto');

	function index() {
		$this->Venda->recursive = 0;
		$this->set('vendas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Venda.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('venda', $this->Venda->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Venda->create();
			if ($this->Venda->save($this->data)) {
				$this->Session->setFlash(__('The Venda has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Venda could not be saved. Please, try again.', true));
			}
		}
		$pedidos = $this->Venda->Pedido->find('list');
		$situacoes = $this->Venda->Situacao->find('list');
		$boletos = $this->Venda->Boleto->find('list');
		$this->set(compact('pedidos', 'situacoes', 'boletos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Venda', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Venda->save($this->data)) {
				$this->Session->setFlash(__('The Venda has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Venda could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Venda->read(null, $id);
		}
		$pedidos = $this->Venda->Pedido->find('list');
		$situacoes = $this->Venda->Situacao->find('list');
		$boletos = $this->Venda->Boleto->find('list');
		$this->set(compact('pedidos','situacoes','boletos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Venda', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Venda->del($id)) {
			$this->Session->setFlash(__('Venda deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

        function carrinho($id){
            $this->Produto->recursive = -1;
            $result = $this->Produto->read(null,$id);
            $produtos = $this->Session->read('carrinho');
            if(isset($produtos)){
                $existe = false;
                foreach ($produtos as $key => $value) {
                    if($key == $result['Produto']['codigo']){
                        $existe = true;
                        $produtos[$result['Produto']['codigo']]['qtde'] = $value['qtde']+1;
                    }
                }
                if($existe == false){
                    $produtos[$result['Produto']['codigo']]['id'] = $id;
                    $produtos[$result['Produto']['codigo']]['codigo'] = $result['Produto']['codigo'];
                    $produtos[$result['Produto']['codigo']]['descricao'] = $result['Produto']['titulo'];
                    $produtos[$result['Produto']['codigo']]['qtde'] = 1;
                }
                
            }
            else{
                $produtos[$result['Produto']['codigo']]['id'] = $id;
                $produtos[$result['Produto']['codigo']]['codigo'] = $result['Produto']['codigo'];
                $produtos[$result['Produto']['codigo']]['descricao'] = $result['Produto']['titulo'];
                $produtos[$result['Produto']['codigo']]['qtde'] = 1;
            }
            $this->Session->write('carrinho', $produtos);
            print_r($this->Session->read('carrinho'));exit;
        }

}
?>