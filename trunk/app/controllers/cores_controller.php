<?php
class CoresController extends AppController {

    var $name = 'Cores';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $components = array('Upload');

    function index() {
        $this->Cor->recursive = 0;
        $this->set('cores', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Cor.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('cor', $this->Cor->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Cor->create();
            $imgOk = array();
            if(!empty ($this->data['Cor']['diretorio'])) {
                $imgOk = $this->salvarArquivo($this->data['Cor']['diretorio']);
                $this->data['Cor']['diretorio'] = $imgOk['diretorio'];
            }

            if(number_format($imgOk['erros']) == 0) {
                if ($this->Cor->save($this->data)) {
                    $this->Session->setFlash(__('A Cor foi salva com sucesso!', true));
                    $this->redirect(array('action'=>'index'));
                } else {
                    $this->Session->setFlash(__('A Cor não pôde ser salva. Por favor, tente novamente.', true));
                }
            }
            else
                $this->Session->setFlash(__('Extensão de imagem não permitida.', true));
        }
        $this->set(compact('produtos'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Cor', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if(empty($this->data['Cor']['diretorio']['name']))
                unset($this->data['Cor']);
            
            $imgOk = array();
            if(!empty ($this->data['Cor']['diretorio']['name'])) {
                $imgOk = $this->salvarArquivo($this->data['Cor']['diretorio']);
                $this->data['Cor']['diretorio'] = $imgOk['diretorio'];
            }

            if(number_format($imgOk['erros']) == 0) {
                $this->Cor->begin();
                $result = $this->Cor->read(null, $id);
                
                if($this->deletaArquivo($result['Cor']['diretorio']))
                {
                    if ($this->Cor->save($this->data)) {
                        $this->Cor->commit();
                        $this->Session->setFlash(__('A Cor foi salva com sucesso!', true));
                        $this->redirect(array('action'=>'index'));
                    } else {
                        $this->Cor->rollback();
                        $this->Session->setFlash(__('A Cor não pôde ser salva. Por favor, tente novamente.', true));
                    }
                }
                else{
                    $this->Cor->rollback();
                    $this->Session->setFlash(__('A Cor não pôde ser salva. Por favor, tente novamente.', true));
                }
            }
            else
                $this->Session->setFlash(__('Extensão de imagem não permitida.', true));
        }
        if (empty($this->data)) {
            $this->data = $this->Cor->read(null, $id);
        }
        $this->set(compact('produtos'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Id de Cor inválido', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Cor->begin();
        $result = $this->Cor->read(null, $id);
        if ($this->Cor->del($id)) {
            if($this->deletaArquivo($result['Cor']['diretorio'])){
                $this->Cor->commit();
                $this->Session->setFlash(__('A Cor foi excluída com sucesso!', true));
                $this->redirect(array('action'=>'index'));
            }
            else{
                $this->Session->setFlash(__('A Cor não pôde ser excluída. Por favor, tente novamente.', true));
                $this->Cor->rollback();
            }
            
        }
        else
            $this->Cor->rollback();
    }

    function salvarArquivo($arquivo) {
        $path = "img_cores";
        $this->Upload->setPath($path);
        $result = array();
        $backup = array();
        $erros = 0;
        
        if(number_format($arquivo['error']) == 0) {
            $trans = array("ç"=>"c"," "=>"_","á"=>"a","é"=>"e","í"=>"i","ó"=>"o","ú"=>"u");
            $arquivo['name'] = strtr($arquivo['name'], $trans);
            $novo_arquivo = $this->Upload->copyUploadedFile($arquivo, '');
            
            if(!empty($novo_arquivo)) {
                $backup = $novo_arquivo;
                $result['diretorio'] = "$path/$novo_arquivo";
            }
            else
                $erros++;
        }
        else
            $erros++;
        if($erros>0) {
            $this->deletaArquivo($backup);
            $result = array();
        }
        $result['backup'] = $backup;
        $result['erros'] = $erros;
        return $result;
    }

    function deletaArquivo($backup) {
        return unlink($backup);
    }

}
?>