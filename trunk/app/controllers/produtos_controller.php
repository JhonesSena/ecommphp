<?php
class ProdutosController extends AppController {

    var $name = 'Produtos';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $components = array('Upload');
    var $uses = array('Produto', 'Imagem');
    var $paginate = array(
            'limit'=>10,
            'order'=>array('Produto.descricao'=>'asc')
    );

    function index() {
        $this->Produto->recursive = 1;

        $this->set('produtos', $this->paginate('Produto',array('Produto.ativo'=>true)));
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Produto inválido.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('produto', $this->Produto->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $imgOk = array();
            $imgOk['erros'] = 0;
            if(!empty ($this->data['Imagem']['0']['name'])) {
                $imgOk = $this->salvarArquivos($this->data['Imagem'], $this->data['Produto']['codigo']);
                $this->data['Imagem'] = $imgOk['Imagem'];
            }
            else
                unset($this->data['Imagem']);
            if(number_format($imgOk['erros']) == 0) {
                $this->Produto->create();
//                        print_r($this->data);exit;
                if ($this->Produto->saveAll($this->data)) {
                    $this->Session->setFlash(__('O Produto foi salvo com sucesso', true));
                    $this->redirect(array('action'=>'index'));
                } else {
                    $this->deletaArquivos($this->data['backup'], $path);
                    $this->Session->setFlash(__('O Produto não pôde ser salvo. Por favor, tente novamente.', true));
                }
            }
            else
                $this->Session->setFlash(__('Extensão de imagem não permitida.', true));
        }
        $grupos = $this->Produto->Grupo->find('list');
        $this->set(compact('grupos'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Produto invalido', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            $imgOk = array();
            $imgOk['erros'] = 0;
            if(!empty ($this->data['Imagem']['0']['name'])) {
                $imgOk = $this->salvarArquivos($this->data['Imagem'], $this->data['Produto']['codigo']);
                $this->data['Imagem'] = $imgOk['Imagem'];
            }
            else
                unset($this->data['Imagem']);
            if(number_format($imgOk['erros']) == 0) {
                if($this->data['Preco'][0]['preco'] != ''){
                    if($this->data['Preco'][0]['preco'] != $this->data['Preco'][1]['preco'] ||
                            $this->data['Preco'][0]['desconto_por_pacote'] != $this->data['Preco'][1]['desconto_por_pacote'] ||
                            $this->data['Preco'][0]['pacote'] != $this->data['Preco'][1]['pacote']) {
                        $this->data['Preco'][0]['ativo'] = false;
                    }
                    else
                        unset($this->data['Preco']);
                }
                else{
                    unset($this->data['Preco'][0]);
                    $this->data['Preco'][1]['ativo'] = true;
                }

                
                if ($this->Produto->saveAll($this->data)) {
                    $this->Session->setFlash(__('O Produto foi salvo com sucesso.', true));
                    $this->redirect(array('action'=>'index'));
                } else {
                    $this->deletaArquivos($this->data['backup'], $path);
                    $this->Session->setFlash(__('O Produto não pode ser salvo, tente novamente.', true));
                }
            }
            else
                $this->Session->setFlash(__('Extensão de imagem não permitida.', true));
        }
        if (empty($this->data)) {
            $this->data = $this->Produto->read(null, $id);
        }
        $grupos = $this->Produto->Grupo->find('list');
        $this->set(compact('grupos'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Id inválido para o Produto', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Produto->del($id)) {
            $this->Session->setFlash(__('Produto deletado', true));
            $this->redirect(array('action'=>'index'));
        }
    }

    function salvarArquivos($arquivos, $codProduto) {
        $path = "img_produtos";
        $this->Upload->setPath($path);
        $result = array();
        $backup = array();
        $erros = 0;
        foreach ($arquivos as $key => $value) {
            if(number_format($value['error']) == 0) {
                $trans = array("ç"=>"c"," "=>"_","á"=>"a","é"=>"e","í"=>"i","ó"=>"o","ú"=>"u");
                $value['name'] = strtr($value['name'], $trans);
                $value['name'] = $codProduto.''.$value['name'];
                $novo_arquivo = $this->Upload->copyUploadedFile($value, '');
                if(!empty($novo_arquivo)) {
                    $backup[$key] = $novo_arquivo;

                    $result['Imagem'][$key]['diretorio'] = $path;
                    $result['Imagem'][$key]['nome'] = $novo_arquivo;
//                        $result['Imagem'][$key]['tipo'] = $value['type'];
                    $result['Imagem'][$key]['tamanho_arquivo'] = number_format($value['size']/1024, 2) . " KB";
                    $result['Imagem'][$key]['ativo'] = true;
                }
                else
                    $erros++;
            }
        }
        if($erros>0) {

            $this->deletaArquivos($backup, $path);
            $result = array();
        }
        $result['backup'] = $backup;
        $result['erros'] = $erros;
        return $result;
    }

    function deletaArquivos($backup, $path) {
        foreach ($backup as $key => $back) {
            unlink($path.'/'.$back);
        }
    }

}
?>