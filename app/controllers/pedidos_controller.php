<?php


class PedidosController extends AppController {

    var $name = 'Pedidos';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $uses = array('Pedido','ItensPedido', 'Preco', 'ClientePedido', 'Cedente');
    var $paginate = array(
            'order'=>array('Pedido.id'=>'desc'),
            'joins'=>array(
                array(
                        'table' => 'cliente_pedidos',
                        'alias' => 'ClientePedido',
                        'type' => 'LEFT',
                        'conditions' => array(
                                        'ClientePedido.pedido_id = Pedido.id',
                        )

                )
            )
    );

    function index() {
        $this->Pedido->recursive = 1;
        $usuarioSession = $this->Session->read('Cliente');
        $pedidos = $this->paginate(array('ClientePedido.cliente_id'=>$usuarioSession['Cliente']['id']));
//        print_r($pedidos);
        $this->set('pedidos', $pedidos);//array('ClientePedido.cliente_id'=>$clienteSession['Cliente']['id'], 'Pedido.ativo'=>true)
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Pedido Inválido.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->ItensPedido->recursive = 1;
        $itens = $this->ItensPedido->find('all', array('conditions'=>array('ItensPedido.pedido_id'=>$id)));

        $arrayProdutos = array();
        $chaveProduto = 0;

        foreach($itens as $key => $item){
            $precoPeriodo = $this->Preco->find('first',array('order'=>array('Preco.created'=>'desc'),'conditions'=>array("Preco.created <= '".$item['Pedido']['created']."'",
                'Produto.id'=>$item['ItensPedido']['produto_id'])));
            $itens[$key] = Set::merge($itens[$key],$precoPeriodo);

            $existProduto = $this->recursiveArraySearch($arrayProdutos, $item['Produto']['codigo'], 'cod_produto');
            if($existProduto) {
                //Chave no array, do produto já existente
                $chaveProduto = $existProduto-1;
            }
            else {
                //Pega última chave do produto e soma uma unidade
                $chaveProduto = array_pop(array_keys($arrayProdutos)) + 1;
            }
            
            if(empty($arrayProdutos)){
                $arrayProdutos[0]['cod_produto'] = $item['Produto']['codigo'];
                $arrayProdutos[0]['descricao_produto'] = $item['Produto']['descricao'];
                $arrayProdutos[0]['preco'] = $itens[$key]['Preco']['preco'];
                $arrayProdutos[0]['pacote'] = $itens[$key]['Preco']['pacote'];
                $arrayProdutos[0]['desconto'] = $itens[$key]['Preco']['desconto_por_pacote'];
                $arrayProdutos[0]['qtde'] = $item['ItensPedido']['qtde'];
            }
            else{
                $arrayProdutos[$chaveProduto]['cod_produto'] = $item['Produto']['codigo'];
                $arrayProdutos[$chaveProduto]['descricao_produto'] = $item['Produto']['descricao'];
                $arrayProdutos[$chaveProduto]['preco'] = $itens[$key]['Preco']['preco'];
                $arrayProdutos[$chaveProduto]['pacote'] = $itens[$key]['Preco']['pacote'];
                $arrayProdutos[$chaveProduto]['desconto'] = $itens[$key]['Preco']['desconto_por_pacote'];
                if(!empty($arrayProdutos[$chaveProduto]['qtde']))
                    $arrayProdutos[$chaveProduto]['qtde'] += $item['ItensPedido']['qtde'];
                else
                    $arrayProdutos[$chaveProduto]['qtde'] = $item['ItensPedido']['qtde'];
            }
        }

        $descontoTotal = 0;
        $totalProduto = 0;
        foreach ($arrayProdutos as $key => $value){
            $preco = str_replace('R$','',str_replace(',','.',$value['preco']));
            $percentualDesconto = $value['desconto'];
            $resto = $value['qtde'] % $value['pacote'];
            $divisao = (int) ($value['qtde'] / $value['pacote']);
            $subtotal_descontado = number_format($preco, 2) * ($divisao * $value['pacote']);
            $subtotal_descontado = $subtotal_descontado - ($percentualDesconto / 100 * $subtotal_descontado);
            $subtotal_restante = number_format($preco, 2) * $resto;
            $subtotal = $subtotal_descontado + $subtotal_restante;
            $desconto = (number_format($preco, 2) * $value['qtde']) - $subtotal;
            $descontoTotal += $desconto;
            if($divisao > 0 && $percentualDesconto > 0){
                $resumoDesconto[$key]['codigo'] = $value['cod_produto'];
                $resumoDesconto[$key]['descricao_produto'] = $value['descricao_produto'];
                $resumoDesconto[$key]['qtde_pacote'] = $divisao;
                $resumoDesconto[$key]['desconto'] = 'R$'.number_format($desconto, 2, ',', '.');
                $resumoDesconto[$key]['percentual'] = number_format($percentualDesconto, 2, ',', '.');
            }
            else{
                $subtotal = number_format($preco, 2) * $value['qtde'];
            }
            $totalProduto += $subtotal;
        }
        $total = $totalProduto + str_replace(',', '.', $itens[0]['Pedido']['valor_frete']);
        $compact = compact('itens', 'descontoTotal', 'totalProduto', 'total', 'resumoDesconto');
        $this->set($compact);
        return $total;
    }

    function add() {
        $carrinhoSession = $this->Session->read('carrinho');
        $i = 0;
        $totalPeso = 0;
        foreach ($carrinhoSession as $keyProduto => $produto) {
            foreach ($produto['item'] as $keyItem => $item) {
                $this->data['ItensPedido'][$i]['produto_id'] = $produto['id'];
                if(isset($item['id']))
                    $this->data['ItensPedido'][$i]['item_id'] = $item['id'];
                if($item['qtde'] > 0) {
                    $this->data['ItensPedido'][$i]['qtde'] = $item['qtde'];
                    $this->data['ItensPedido'][$i]['ativo'] = true;
                    $i++;
                    $totalPeso += str_replace(',','.',$produto['peso']) * $item['qtde'];
                }
            }
        }
        $clienteSession = $this->Session->read('Cliente');
        $this->Cedente->recursive = 0;
        $cedente = $this->Cedente->find('first', array('conditions'=>array('Cedente.ativo'=>true)));
        $frete = $this->calculaFrete('40010', $cedente['Cliente']['cep'], $clienteSession['Cliente']['cep'], ($totalPeso/1000));
        
        if(!isset($frete['calculo_precos']['erro']['codigo'])) {
            $frete['calculo_precos']['erro']['codigo'] = '7';
            $frete['calculo_precos']['erro']['descricao'] = 'Não foi possível conectar ao serviço do correio.';
        }
        $errosFrete['codigo'] = $frete['calculo_precos']['erro']['codigo'];
        $errosFrete['descricao'] = $frete['calculo_precos']['erro']['descricao'];
        $frete = $frete['calculo_precos']['dados_postais']['preco_postal'];
//        $frete = number_format($frete, 2, ',','.');

        $this->data['Pedido']['valor_frete'] = $frete;
        $this->data['Pedido']['situacao_pedido_id'] = 2;
        
        if (!empty($this->data)) {
            if(empty($errosFrete['codigo'])){
                $this->Pedido->begin();
                $this->Pedido->create();
                if ($this->Pedido->saveAll($this->data, array('atomic'=>false, 'validate'=>'first'))) {
                    $idPedido = $this->Pedido->id;
                    $this->data['ClientePedido']['cliente_id'] = $clienteSession['Cliente']['id'];
                    $this->data['ClientePedido']['pedido_id'] = $idPedido;
                    unset($this->data['Pedido']);
                    unset($this->data['ItensPedido']);
                    if($this->ClientePedido->save($this->data)){
                        $this->Pedido->commit();
                        $this->Session->setFlash(__('O Pedido foi finalizado com sucesso!', true));
                        $this->Session->del('carrinho');
                        $this->redirect(array('action'=>'view', $idPedido));
                    }
                    else{
                        $this->Pedido->rollback();
                        $this->Session->setFlash(__('O Pedido não pôde ser finalizado. Por favor, tente novamente.', true));
                        $this->redirect(array('controller'=>'shopps','action'=>'carrinho', 'true'));
                    }
                }else{
                    $this->Session->setFlash(__('O Pedido não pôde ser finalizado. Por favor, tente novamente.', true));
                }
            } else {
                $this->Pedido->rollback();
                $this->Session->setFlash(__('O Pedido não pôde ser finalizado, devido a um erro no cálculo de frete. Por favor, tente novamente.', true));
                $this->redirect(array('controller'=>'shopps','action'=>'carrinho', 'true'));
            }
        }
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Pedido', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Pedido->save($this->data)) {
                $this->Session->setFlash(__('The Pedido has been saved', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The Pedido could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Pedido->read(null, $id);
        }
        $situacoes = $this->Pedido->Situacao->find('list');
        $clientes = $this->Pedido->Cliente->find('list');
        $produtos = $this->Pedido->Produto->find('list');
        $this->set(compact('situacoes','clientes','produtos'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Pedido', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Pedido->del($id)) {
            $this->Session->setFlash(__('Pedido deleted', true));
            $this->redirect(array('action'=>'index'));
        }
    }

}
?>