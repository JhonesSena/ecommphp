<?php
class BancosController extends AppController {

    var $name = 'Bancos';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $components = array('Upload');

    function add() {
        if (!empty($this->data)) {
            
            $this->Banco->create();
            $imgOk = array();
            if(!empty ($this->data['Banco']['logo'])) {
                $imgOk = $this->salvarArquivo($this->data['Banco']['logo']);
                $this->data['Banco']['logo'] = $imgOk['logo'];
            }
            if(number_format($imgOk['erros']) == 0) {
                
                if ($this->Banco->save($this->data)) {
                    $this->Session->setFlash(__('A Banco foi salvo com sucesso!', true));
                    $this->redirect(array('action'=>'index'));
                } else {
                    $this->Session->setFlash(__('A Banco não pôde ser salvo. Por favor, tente novamente.', true));
                }
            }
            else
                $this->Session->setFlash(__('Extensão de imagem não permitida.', true));
        }
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Banco inválida', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            $imgOk = array();
            if(!empty ($this->data['Banco']['logo'])) {
                $imgOk = $this->salvarArquivo($this->data['Banco']['logo']);
                $this->data['Banco']['logo'] = $imgOk['logo'];
            }

            if(number_format($imgOk['erros']) == 0) {
                $this->Banco->begin();
                    $result = $this->Banco->read(null, $id);
                if($this->deletaArquivo($result['Banco']['logo']))
                {
                    if ($this->Banco->save($this->data)) {
                        $this->Banco->commit();
                        $this->Session->setFlash(__('A Banco foi salvo com sucesso!', true));
                        $this->redirect(array('action'=>'index'));
                    } else {
                        $this->Banco->rollback();
                        $this->Session->setFlash(__('A Banco não pôde ser salvo. Por favor, tente novamente.', true));
                    }
                }
                else{
                    $this->Banco->rollback();
                    $this->Session->setFlash(__('A Banco não pôde ser salvo. Por favor, tente novamente.', true));
                }
            }
            else
                $this->Session->setFlash(__('Extensão de imagem não permitida.', true));
        }
        if (empty($this->data)) {
            $this->data = $this->Banco->read(null, $id);
        }
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Id de Banco inválido', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Banco->begin();
        $result = $this->Banco->read(null, $id);
        if ($this->Banco->del($id)) {
            if($this->deletaArquivo($result['Banco']['logo'])){
                $this->Banco->commit();
                $this->Session->setFlash(__('A Banco foi excluído com sucesso!', true));
                $this->redirect(array('action'=>'index'));
            }
            else{
                $this->Session->setFlash(__('A Banco não pôde ser excluído. Por favor, tente novamente.', true));
                $this->Banco->rollback();
            }

        }
        else
            $this->Banco->rollback();
    }

    function salvarArquivo($arquivo) {
        $path = "img";
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
                $result['logo'] = "$path/$novo_arquivo";
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