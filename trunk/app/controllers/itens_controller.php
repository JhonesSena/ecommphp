<?php
class ItensController extends AppController {

    var $name = 'Itens';
    var $helpers = array('Html', 'Form', 'Jquery');
    public $paginate = array('Item'=>array(
                 'order' => 'Produto.descricao, Item.codigo'
            )
    );

//    function index() {
//        $this->Item->recursive = 0;
//        $this->set('itens', $this->paginate());
//    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Item inválido.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('item', $this->Item->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Item->create();
            if ($this->Item->save($this->data)) {
                $this->Session->setFlash(__('O Item foi salvo com sucesso!', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $db_error = $this->Item->getError();
                if($db_error){
                    $this->Session->setFlash(__($db_error, true));
                }else{
                    $this->Session->setFlash(__('O Item não pôde ser salvo. Por favor, tente novamente.', true));
                }
            }
        }
        $cores = $this->Item->Cor->find('list');
        $produtos = $this->Item->Produto->find('list');
        $this->set(compact('produtos', 'cores'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Item', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Item->save($this->data)) {
                $this->Session->setFlash(__('O Item foi salvo com sucesso!', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $db_error = $this->Item->getError();
                if($db_error){
                    $this->Session->setFlash(__($db_error, true));
                }else{
                    $this->Session->setFlash(__('O Item não pôde ser salvo. Por favor, tente novamente.', true));
                }
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Item->read(null, $id);
        }
        $cores = $this->Item->Cor->find('list');
        $produtos = $this->Item->Produto->find('list');
        $this->set(compact('produtos', 'cores'));
    }

//    function delete($id = null){
//        if (!$id) {
//            $this->Session->setFlash(__('Identificador inválido para o Item', true));
//            $this->redirect(array('action'=>'index'));
//        }
//        if ($this->Item->del($id)) {
//            $this->Session->setFlash(__('O Item foi Excluido', true));
//            $this->redirect(array('action'=>'index'));
//        }
//    }
}
?>