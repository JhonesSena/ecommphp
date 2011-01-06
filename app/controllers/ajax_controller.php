<?php

App::import('Controller', 'Shopps');
App::import('Core', 'HttpSocket');
class AjaxController extends Controller {

    var $name = 'Ajax';
    var $components = array('RequestHandler');
    var $helpers = array('Html', 'Form', 'Jquery');
    var $uses = array('Produto', 'Imagem', 'Item', 'Estado', 'Receita','ItemReceita');

    function beforeFilter () {
        // adicione ao método allow as actions que quer permitir sem o usuário estar logado
        //$this->Auth->allow('*');
//        print_r($this->Auth);

//        if($this->Session->check("Usuario")==false){
//            $this->layout = '';
//            Configure::delete('debug');
//            $webroot = $_SERVER['SERVER_NAME'] . '' . $this->webroot;
//            $this->Session->setFlash(__('Sessão expirada!', true));
//            print("<script language = 'javascript'>window.location='$webroot"."users/login'</script>");
//            exit;
//        }

        if(!$this->RequestHandler->isAjax()){
            $this->layout = '';
            Configure::write('debug', 0);
            $webroot = $this->webroot;
            $this->Session->setFlash(__('Acesso não permitido.', true));
            print("<script language = 'javascript'>window.location='$webroot"."pages'</script>");
            exit();
        }
    }

    function delete_imagem_for_produto($idImg = null, $idProduto = null) {
        $this->layout = 'ajax';
        Configure::delete('debug');
        $sucesso = true;
        if($idImg && $idProduto) {
            $imagem = $this->Imagem->read(null, $idImg);
            $this->Imagem->begin();
            if ($this->Imagem->del($idImg)) {
                if($this->deleta_imagem_servidor($imagem['Imagem']['nome']))
                        $this->Imagem->commit();
                else{
                    $this->Imagem->rollback();
                    $sucesso = false;
                }
            }
            else{
                $this->Imagem->rollback();
                $sucesso = false;
            }
            $result = $this->Produto->read(null, $idProduto);
        }
        else
            $sucesso = false;
        $this->set(compact('result', 'sucesso'));
        $this->render('json', 'ajax', '/produtos/delete_imagem_for_produto');
    }

    function deleta_imagem_servidor($nome){
        $path = 'img_produtos';
        return unlink($path.'/'.$nome);
    }

    function carrega_itens_by_produto($id = null){
        $this->layout = 'ajax';
        Configure::delete('debug');

        $result = $this->Produto->Item->find('all', array('conditions'=>array('Produto.id'=>$id),'order'=>array('Produto.descricao'=>'asc')));
//        $this->Produto->recursive = -1;
        $produto = $this->Produto->read(null, $id, array('order'=>array('Produto.descricao'=>'asc')));
        $this->set(compact('result', 'produto'));
        $this->render('json', 'ajax', '/produtos/carrega_itens_by_produto');
    }

    function add_carrinho(){
        $this->layout = 'ajax';
        Configure::delete('debug');

        $itens = $this->data();

        $this->Session->write('carrinho', $itens);
        
        $this->set(compact('results'));
        $this->render('json', 'ajax', '/ajax/json');
    }

    function atualizaItemCarrinho($chave, $valor){
        $this->layout = 'ajax';
        Configure::delete('debug');
        
        $explode = explode('-', $chave);
        $carrinhoSession = $this->Session->read('carrinho');
        $results = false;
        
        if($valor==''){
            $valor = 0;
        }

        if($carrinhoSession){
            $c = new ShoppsController();
            $c->constructClasses();
            $carrinhoSession[$explode[0]]['item'][$explode[1]]['qtde'] = $valor;
            $this->Session->write('carrinho', Set::merge($carrinhoSession));
            $results = $this->Session->read('carrinho');
            $results = $c->carrinho('true');
            if($results){
                $resumo = $results['resumo'];
                $totalProduto = $results['totalProduto'];
                $frete = $results['frete'];
                $total = $results['total'];
                $errosFrete = $results['errosFrete'];
                $resumoDesconto = $results['resumoDesconto'];
                $descontoTotal = $results['descontoTotal'];
                $totalSemDesconto = $results['totalSemDesconto'];
            }
        }
        $this->set(compact('resumo', 'total', 'totalProduto', 'frete', 'errosFrete', 'resumoDesconto', 'descontoTotal', 'totalSemDesconto'));
        $this->render('json', 'ajax', '/shopps/atualizaQtde');
    }

    function validaCep($cep){
        $this->layout = 'ajax';
        Configure::delete('debug');
        $params['formato'] = 'xml';
        $params['cep'] = preg_replace('/[^0-9]/', '', $cep);
        $url = "http://cep.republicavirtual.com.br/web_cep.php";
        $HttpSocket = new HttpSocket();
        $results = $HttpSocket->get($url, $params);
        $results = $this->xmlToArray($results);
        $estado = $this->Estado->find('list', array('fields'=>'Estado.id','conditions'=>array('Estado.sigla'=>$results['webservicecep']['uf'])));
        foreach ($estado as $value){
            $estado = $value;
        }
        if($estado)
            $results['webservicecep']['estado'] = $estado;
        else
            $results['webservicecep']['estado'] = '';
        print json_encode($results);
        $this->render('json', 'ajax', '/ajax/json');
    }

    function update_sequencia_receita($receitaId, $vetor){
        $this->layout = 'ajax';
        Configure::delete('debug');
        $results = false;
        $vetor = $this->jsonString2arr(base64_decode($vetor));
        $array = array();
        foreach ($vetor as $key => $value) {
            $separa_atr = explode(';', $value);
            $id = $separa_atr[0]; //Id da atividade do vetor
            $sequencia = $separa_atr[1]; //Sequencia da atividade do vetor
            $array = Set::merge($array,array($key => array("ItemReceita" => array('id' => $id, 'sequencia' => $sequencia))));
        }
        if($this->ItemReceita->saveAll($array)){
            $results = "true";
        } else {
            $results = "false";
        }
        $this->set(compact('results'));
        $this->render('json', 'ajax', '/ajax/json');
    }

    //Retorna um array com base em um objeto json codificado na base 64
    function jsonString2arr($json) {
        $json = str_replace("{", "(", $json);
        $json = str_replace("}", ")", $json);
        $json = str_replace(":", "=>", $json);
        eval('$ret=array' . $json . ";");
        return $ret;
    }
}
?>