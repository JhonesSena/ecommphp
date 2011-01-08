<?php

class ReceitasController extends AppController {

    var $name = 'Receitas';
    var $helpers = array('Html', 'Form');
    var $components = array('Upload');

    function beforeFilter () {
        // executa o beforeFilter do AppController
        parent::beforeFilter();
        // adicione ao método allow as actions que quer permitir sem o usuário estar logado
        $this->Auth->allow('visualizar');
    }

    function index() {
        $this->Receita->recursive = 0;
        $this->set('receitas', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Receita Inválida.', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('receita', $this->Receita->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $imgOk = array();
            if(!empty ($this->data['Receita']['imagem'])) {
                $imgOk = $this->salvarArquivo($this->data['Receita']['imagem']);
                $this->data['Receita']['imagem'] = $imgOk['diretorio'];
            }

            if(number_format($imgOk['erros']) == 0) {
                $this->Receita->create();
                if ($this->Receita->save($this->data)) {
                    $this->Session->setFlash(__('A Receita foi salva com sucesso.', true));
                    $id = $this->Receita->id;
                    $this->redirect(array('action' => 'edit', "$id#tab2"));
                } else {
                    $this->deletaArquivo($this->data['Receita']['imagem']);
                    $this->Session->setFlash(__('A Receita não pôde er salva. Por favor tente novamente.', true));
                }
            }else{
                $this->Session->setFlash(__('Extensão de imagem não permitida.', true));
            }
        }
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Receita Inválida.', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            $imgOk = array();
            if(!empty ($this->data['Receita']['imagem'])) {
                $imgOk = $this->salvarArquivo($this->data['Receita']['imagem']);
                $this->data['Receita']['imagem'] = $imgOk['diretorio'];
            }

            if(number_format($imgOk['erros']) == 0) {
                if ($this->Receita->save($this->data)) {
                    $this->Session->setFlash(__('A Receita foi salva com sucesso.', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->deletaArquivo($this->data['Receita']['imagem']);
                    $this->Session->setFlash(__('A Receita não pôde er salva. Por favor tente novamente.', true));
                }
            }else{
                $this->Session->setFlash(__('Extensão de imagem não permitida.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Receita->read(null, $id);
        }
        $itensReceita = $this->data['ItemReceita'];
        $this->set(compact('itensReceita'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Identificador de Receita inválido', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Receita->del($id)) {
            $this->Session->setFlash(__('Receita excluida', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function salvarItemReceita($idReceita=null) {
        if (!empty($this->data)) {
            $ultimaSequencia = $this->Receita->ItemReceita->find('first', array('fields' => array('ItemReceita.sequencia'), 'conditions' => array('Receita.id' => $idReceita), 'order' => array('ItemReceita.sequencia desc')));
            if(empty($ultimaSequencia)){
                $sequencia = 0;
            }else{
                $sequencia = $ultimaSequencia['ItemReceita']['sequencia'] + 1;
            }
            $this->data['ItemReceita']['sequencia'] = $sequencia;
            $this->data['ItemReceita']['receita_id'] = $idReceita;

            $dadosUpload['erros'] = 0;
            if(!empty($this->data['ItemReceita']['imagem'])){
                $dadosUpload = $this->salvarArquivo($this->data['ItemReceita']['imagem']);
            }
            if(!empty ($this->data['ItemReceita']['id'])){
                unset($this->data['ItemReceita']['sequencia']);
            }
            if(floor($dadosUpload['erros']) > 0){
                $this->Session->setFlash(__('Ocorreu um erro ao salvar imagem.', true));
            }else{
                if(!empty($this->data['ItemReceita']['imagem'])){
                    $this->data['ItemReceita']['imagem'] = $dadosUpload['diretorio'];
                }
                $this->Receita->create();
                if ($this->Receita->ItemReceita->save($this->data)) {
                    $this->Session->setFlash(__('Item foi salvo com sucesso.', true));
                    $this->redirect(array('action' => "edit", "$idReceita#tab2"));
                } else {
                    $this->deletaArquivo($dadosUpload['backup']);
                    $this->Session->setFlash(__('Item não pôde ser salvo. Por favor, tente novamente.', true));
                }
            }
        }
        $receita = $this->Receita->read(null, $idReceita);
        $this->data['Receita'] = $receita['Receita'];
        $itensReceita = $receita['ItemReceita'];
        $this->set(compact('itensReceita'));
        $this->render("edit");
    }

    function salvarArquivo($arquivo) {
        $path = "img_receitas";
        $this->Upload->setPath($path);
        $result = array();
        $backup = array();
        $erros = 0;

        if (number_format($arquivo['error']) == 0) {
            $trans = array("ç" => "c", " " => "_", "á" => "a", "é" => "e", "í" => "i", "ó" => "o", "ú" => "u");
            $arquivo['name'] = strtr($arquivo['name'], $trans);
            $novo_arquivo = $this->Upload->copyUploadedFile($arquivo, '');

            if (!empty($novo_arquivo)) {
                $backup = $novo_arquivo;
                $result['diretorio'] = $novo_arquivo;
            }
            else
                $erros++;
        }
        else
            $erros++;
        if ($erros > 0) {
            $this->deletaArquivo($backup);
            $result = array();
        }
        $result['backup'] = $backup;
        $result['erros'] = $erros;
        return $result;
    }

    function deletaArquivo($backup=null) {
        $diretorio = "img_receitas";
        return unlink("$diretorio/$backup");
    }

    function excluirImagem($idReceita){
        $receita = $this->Receita->read(null, $idReceita);
        $dados['Receita']['id'] = $idReceita;
        $dados['Receita']['imagem'] = '';

        if ($this->Receita->save($dados)) {
            $this->deletaArquivo($receita['Receita']['imagem']);
            $this->redirect(array('action' => 'edit',$idReceita));
        }
        $this->render("edit/$idReceita");
    }
    function excluirItemReceita($idItem, $id){
        if (!$id) {
            $this->Session->setFlash(__('Identificador de Item de Receita inválido', true));
            $this->redirect(array('action' => 'edit',"$idItem#tab2"));
        }
        if ($this->Receita->ItemReceita->del($id)) {
            $this->Session->setFlash(__('Item do passo a passo excluido', true));
            $this->redirect(array('action' => 'edit',"$idItem#tab2"));
        }
    }

    function visualizar($id=null){
        $this->layout = 'view_receita';
        $receitas = $this->Receita->find('all',array('conditions'=>array('Receita.ativo'=>true)));
        if($id != null){
            $receita = $this->Receita->read(null,$id);
        }else{
            $receita = $this->Receita->find('first',array('conditions'=>array('Receita.ativo'=>true)));
        }
        $itemReceita = json_encode($receita['ItemReceita']);
        $this->set(compact('receitas','receita','itemReceita'));
    }

}

?>