<?php

class ReceitasController extends AppController {

    var $name = 'Receitas';
    var $helpers = array('Html', 'Form');
    var $components = array('Upload');

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
            $this->Receita->create();
            if ($this->Receita->save($this->data)) {
                $this->Session->setFlash(__('A Receita foi salva com sucesso.', true));
                $id = $this->Receita->id;
                $this->redirect(array('action' => 'edit', "$id#tab2"));
            } else {
                $this->Session->setFlash(__('A Receita não pôde er salva. Por favor tente novamente.', true));
            }
        }
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Receita Inválida.', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Receita->save($this->data)) {
                $this->Session->setFlash(__('A Receita foi salva com sucesso.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('A Receita não pôde er salva. Por favor tente novamente.', true));
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
            $sequencia = $ultimaSequencia['ItemReceita']['sequencia'] + 1;
            $this->data['ItemReceita']['sequencia'] = $sequencia;
            $this->data['ItemReceita']['receita_id'] = $idReceita;

            $dadosUpload = $this->salvarArquivo($this->data['ItemReceita']['imagem']);
            if(floor($dadosUpload['erros']) > 0){
                $this->Session->setFlash(__('Ocorreu um erro ao salvar imagem.', true));
            }else{
                $this->data['ItemReceita']['imagem'] = $dadosUpload['diretorio'];
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
        $this->redirect(array('action' => 'edit',$idReceita));
    }

}

?>