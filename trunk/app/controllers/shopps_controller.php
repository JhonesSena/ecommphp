<?php
App::import('Core', 'HttpSocket');
class ShoppsController extends AppController {

    var $name = 'Shopps';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $uses = array('Produto', 'Grupo', 'Item', 'Cedente');
    var $paginate = array(
            'limit' => 8,
            'order'=>array('Produto.descricao'=>'asc')
    );

    function beforeFilter () {
        $this->Allow('view');
        $this->Allow('carrinho');
        // executa o beforeFilter do AppController
        parent::beforeFilter();
    }

    function index($grupo_id = '') {
//        $this->layout = 'cliente';

        if($grupo_id != '') {
            $produtos = $this->paginate('Produto', array('Produto.grupo_id'=>$grupo_id));
        }
        else {
            $produtos = $this->paginate();
        }
        $grupos = $this->Grupo->find('list');
        $grupo = $grupo_id;
        $this->set(compact('produtos', 'grupos', 'grupo'));
    }

    function visualizarCarrinho(){
        $compact = $this->carrinho(true);
        $this->set($compact);
        $this->render('carrinho');

    }

    function carrinho($view = false) {
        //Tipos Retorno
        //0(Zero) Operação Ok
        //1(Um) Produto inválido
        if($view) {
            $carrinhoSession = $this->Session->read('carrinho');
            if(empty($carrinhoSession)) {
                $this->Session->setFlash(__('Não existe produtos no carrinho de compras!.', true));
                $this->redirect(array('action'=>'index'));
            }
            else {
                $i = 0;
                $resumo = array();
                $totalProduto = 0;
                $totalSemDesconto = 0;
                $pesoTotal = 0;
                $cubagemTotal = 0;
                $keyDesconto = 0;
                $descontoTotal = 0;
                foreach ($carrinhoSession as $key_produto => $produto) {
                    $somaItens = 0;
                    foreach ($produto['item'] as $key_item => $item) {
                        $item_concatena = '';
                        if(isset($item['cod_item']))
                            $item_concatena = 'Cód.'.$item['cod_item'].' '.$item['titulo_item'];
                        $resumo[$i]['codigo'] = $produto['cod_produto'];
                        $resumo[$i]['descricao'] = $produto['descricao_produto'];
                        $resumo[$i]['item'] = $item_concatena;
                        $resumo[$i]['qtde'] = $item['qtde'];
                        $resumo[$i]['preco'] = $produto['preco'];
                        $resumo[$i]['chave_e'] = $key_produto;
                        $resumo[$i]['chave_i'] = $key_item;


                        $pesoTotal += ($item['qtde'] * (str_replace(',','.',$produto['peso'])));
                        $cubagemTotal += ($item['qtde'] * $produto['cubagem']);
                        
                        $desconto = str_replace(',','.',$produto['desconto']);
                        $preco = str_replace('R$', '', $produto['preco']);
                        $preco = str_replace(',', '.', $preco);
                        $subtotal = number_format($preco, 2) * $item['qtde'];
                        $resumo[$i]['subtotal'] = number_format($subtotal, 2, ',', '.');

                        $somaItens += $item['qtde'];
                        $i++;
                    }
                    $percentualDesconto = $desconto;
                    $desconto = str_replace(',','.',$produto['desconto']);
                    $preco = str_replace('R$', '', $produto['preco']);
                    $preco = str_replace(',', '.', $preco);
                    if($desconto > 0) {
//                            $subtotal = number_format($preco, 2) * $somaItens;
                        $resto = $somaItens % $produto['pacote'];
                        $divisao = (int) ($somaItens / $produto['pacote']);
                        $subtotal_descontado = number_format($preco, 2) * ($divisao * $produto['pacote']);
                        $subtotal_descontado = $subtotal_descontado - ($desconto / 100 * $subtotal_descontado);
                        $subtotal_restante = number_format($preco, 2) * $resto;
                        $subtotal = $subtotal_descontado + $subtotal_restante;
                        $desconto = (number_format($preco, 2) * $somaItens) - $subtotal;
//                            $resumo[$i]['desconto'] = str_replace('.',',',$desconto);
                        $descontoTotal += $desconto;
                        if($divisao > 0){
                            $resumoDesconto[$keyDesconto]['codigo'] = $produto['cod_produto'];
                            $resumoDesconto[$keyDesconto]['descricao'] = $produto['descricao_produto'];
                            $resumoDesconto[$keyDesconto]['qtde_pacote'] = $divisao;
                            $resumoDesconto[$keyDesconto]['desconto'] = 'R$'.number_format($desconto, 2, ',', '.');
                            $resumoDesconto[$keyDesconto]['percentual'] = number_format($percentualDesconto, 2, ',', '.');
                        }

                        $keyDesconto++;
                    }
                    else {
                        $subtotal = number_format($preco, 2) * $somaItens;
                    }
                    $totalSemDesconto += number_format($preco, 2) * $somaItens ;
                    $totalProduto += $subtotal;
                }
                $clienteSession = $this->Session->read('Usuario');

                $this->Cedente->recursive = 0;
                $cedente = $this->Cedente->find('first', array('conditions'=>array('Cedente.ativo'=>true)));
                $frete = $this->calculaFrete('40010', $cedente['Cliente']['cep'], $clienteSession['Cliente']['cep'], ($pesoTotal/1000));
                if(!isset($frete['calculo_precos']['erro']['codigo'])) {
                    $frete['calculo_precos']['erro']['codigo'] = '7';
                    $frete['calculo_precos']['erro']['descricao'] = 'Não foi possível conectar ao serviço do correio.';
                }
                $descontoTotal = $descontoTotal;
                $errosFrete['codigo'] = $frete['calculo_precos']['erro']['codigo'];
                $errosFrete['descricao'] = $frete['calculo_precos']['erro']['descricao'];
                $frete = $frete['calculo_precos']['dados_postais']['preco_postal'];
                $total = number_format($totalProduto + $frete, 2, ',','.');
                $frete = number_format($frete, 2, ',','.');
                $totalProduto = number_format($totalProduto, 2, ',', '.');
                $compact = compact('resumo', 'totalProduto', 'frete', 'total', 'errosFrete', 'resumoDesconto', 'descontoTotal', 'totalSemDesconto');
                $this->set($compact);
                return $compact;
            }
        }
        else {
            Configure::delete('debug');
            $results = '';
            if($this->data) {
                $produto = $this->Produto->read(null, $this->data['Item']['0']['id']);
                if($produto) {
                    $carrinho = array();
                    $carrinhoSession = $this->Session->read('carrinho');
                    $carrinho = $carrinhoSession;
//                    unset($carrinhoSession);
                    if(!empty($carrinhoSession)) {
                        $existProduto = $this->recursiveArraySearch($carrinho, $produto['Produto']['codigo'], 'cod_produto');
                        if($existProduto) {
                            //Chave no array, do produto já existente
                            $chaveProduto = $existProduto-1;
                        }
                        else {
                            //Pega última chave do produto e soma uma unidade
                            $chaveProduto = array_pop(array_keys($carrinho)) + 1;
                        }
                        $carrinho[$chaveProduto]['id'] = $produto['Produto']['id'];
                        $carrinho[$chaveProduto]['cod_produto'] = $produto['Produto']['codigo'];
                        $carrinho[$chaveProduto]['descricao_produto'] = $produto['Produto']['descricao'];
                        $carrinho[$chaveProduto]['preco'] = $produto['Preco'][0]['preco'];
                        $carrinho[$chaveProduto]['desconto'] = $produto['Preco'][0]['desconto_por_pacote'];
                        $carrinho[$chaveProduto]['peso'] = $produto['Produto']['peso_bruto'];
                        $carrinho[$chaveProduto]['cubagem'] = $produto['Produto']['cubagem'];
                        $carrinho[$chaveProduto]['pacote'] = $produto['Preco'][0]['pacote'];

                        foreach ($this->data['Item'] as $key => $value) {
                            if(!empty($value['qtde'])) {
                                if(!empty($value['codigo_item'])) {
                                    $item = $this->Item->find('first', array('conditions'=>array('Item.codigo'=>$value['codigo_item'])));
                                    $existItem = false;
                                    if(isset($carrinho[$chaveProduto]['item'])) {
                                        $existItem = $this->recursiveArraySearch($carrinho[$chaveProduto]['item'], $value['codigo_item'], 'cod_item');
                                    }
                                    if($existItem) {
                                        //Chave no array, do item já existente
                                        $chaveItem = $existItem-1;
                                        $value['qtde'] = $value['qtde'] + $carrinho[$chaveProduto]['item'][$chaveItem]['qtde'];
                                    }
                                    else {
                                        //Pega última chave do produto e soma uma unidade
                                        $chaveItem = array_pop(array_keys($carrinho[$chaveProduto]['item'])) + 1;
                                    }
                                    $carrinho[$chaveProduto]['item'][$chaveItem]['id'] = $item['Item']['id'];
                                    $carrinho[$chaveProduto]['item'][$chaveItem]['cod_item'] = $item['Item']['codigo'];
                                    $carrinho[$chaveProduto]['item'][$chaveItem]['titulo_item'] = $item['Item']['titulo'];
                                    $carrinho[$chaveProduto]['item'][$chaveItem]['qtde'] = $value['qtde'];
                                }
                                else {
                                    $value['qtde'] = $value['qtde'] + $carrinho[$chaveProduto]['item'][0]['qtde'];
                                    $carrinho[$chaveProduto]['item'][0]['qtde'] = $value['qtde'];
                                }
                            }
                        };
                    }
                    else {
                        $carrinho[0]['id'] = $produto['Produto']['id'];
                        $carrinho[0]['cod_produto'] = $produto['Produto']['codigo'];
                        $carrinho[0]['descricao_produto'] = $produto['Produto']['descricao'];
                        $carrinho[0]['preco'] = $produto['Preco'][0]['preco'];
                        $carrinho[0]['desconto'] = $produto['Preco'][0]['desconto_por_pacote'];
                        $carrinho[0]['peso'] = $produto['Produto']['peso_bruto'];
                        $carrinho[0]['cubagem'] = $produto['Produto']['cubagem'];
                        $carrinho[0]['pacote'] = $produto['Preco'][0]['pacote'];
                        foreach ($this->data['Item'] as $key => $value) {
                            if(!empty($value['qtde'])) {
                                if(!empty($value['codigo_item'])) {
                                    $item = $this->Item->find('first', array('conditions'=>array('Item.codigo'=>$value['codigo_item'])));
                                    $carrinho[0]['item'][$key]['id'] = $item['Item']['id'];
                                    $carrinho[0]['item'][$key]['cod_item'] = $item['Item']['codigo'];
                                    $carrinho[0]['item'][$key]['titulo_item'] = $item['Item']['titulo'];
                                    $carrinho[0]['item'][$key]['qtde'] = $value['qtde'];
                                }
                                else {
                                    $value['qtde'] = $value['qtde'] + $carrinhoSession[0]['item'][0]['qtde'];
                                    $carrinho[0]['item'][0]['qtde'] = $value['qtde'];
                                }
                                //                            $retorno = $this->recursiveArraySearch($carrinho, '2602', 'cod_item');
                                //                            $results = array_pop(array_keys($carrinho[0]['item']));
                            }
                        };


                    }
                    $this->Session->write('carrinho', Set::merge($carrinhoSession,$carrinho));
                }
                else {
                    $results = 'O Produto escolhido é inválido. Tente novamente.';
                }
            }
            $this->set(compact('results'));
            $this->render('json', 'ajax', '/ajax/json');
        }
    }

    function limparCarrinho() {
        if($this->Session->del('carrinho')) {
            $this->Session->setFlash(__('Carrinho despejado com sucesso!', true));
            $this->redirect(array('action'=>'index'));
        }
        else {
            $this->Session->setFlash(__('Não foi possível limpar o carrinho de compras. Tente novamente.', true));
        }
    }

    function fecharPedido() {
        
        
        $this->requestAction('/pedidos/add/'.$this->data);
    }
}
?>