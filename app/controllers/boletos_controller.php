<?php
App::import('Controller', 'Pedidos');
class BoletosController extends AppController {

    var $name = 'Boletos';
    var $helpers = array('Html', 'Form');
    var $components  = array('Boletobb');
    var $uses = array('Boleto', 'Cedente', 'Estado');

    function index() {
        $this->Boleto->recursive = 0;
        $this->set('boletos', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Boleto.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('boleto', $this->Boleto->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Boleto->create();
            if ($this->Boleto->save($this->data)) {
                $this->Session->setFlash(__('The Boleto has been saved', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The Boleto could not be saved. Please, try again.', true));
            }
        }
        $cedentes = $this->Boleto->Cedente->find('list');
        $clientes = $this->Boleto->Cliente->find('list');
        $this->set(compact('cedentes', 'clientes'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Boleto', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Boleto->save($this->data)) {
                $this->Session->setFlash(__('The Boleto has been saved', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The Boleto could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Boleto->read(null, $id);
        }
        $cedentes = $this->Boleto->Cedente->find('list');
        $clientes = $this->Boleto->Cliente->find('list');
        $this->set(compact('cedentes','clientes'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Boleto', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Boleto->del($id)) {
            $this->Session->setFlash(__('Boleto deleted', true));
            $this->redirect(array('action'=>'index'));
        }
    }

    function boleto($id) {
        $this->layout = '';
        Configure::delete('debug');
        $p = new PedidosController();
        $p->constructClasses();

        $valor = $p->view($id);
        $clienteSession = $this->Session->read('Cliente');
        $options = array();
        $options['fields'] = array('Cedente.id', 'Cedente.conta_corrente','Cedente.agencia_id', 'Cedente.bloqueto_id',
                'Cliente.id','Cliente.telefone', 'Cliente.email', 'Cliente.logradouro',
                'Cliente.cep', 'Cliente.bairro', 'Cliente.cidade', 'Cliente.nome', 'Cliente.estado_id', 'Cliente.ativo',
                'PessoaFisica.id','PessoaFisica.cpf', 'PessoaJuridica.id', 'PessoaJuridica.cnpj', 'PessoaJuridica.nome_fantasia',
                'Agencia.codigo', 'Bloqueto.carteira', 'Agencia.codigo_cedente', 'Agencia.contrato',
                'Bloqueto.carteira', 'Bloqueto.taxa_boleto','Bloqueto.dias_prazo_pagamento');
        $options['joins'] = array(
                array(
                        'table' => 'clientes',
                        'alias' => 'Cliente',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'Cedente.cliente_id = Cliente.id',
                        )
                ),
                array('table' => 'pessoa_fisicas',
                        'alias' => 'PessoaFisica',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'PessoaFisica.cliente_id = Cliente.id',
                        )
                ),
                array('table' => 'pessoa_juridicas',
                        'alias' => 'PessoaJuridica',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'PessoaJuridica.cliente_id = Cliente.id',
                        )
                ),
                array('table' => 'agencias',
                        'alias' => 'Agencia',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'Cedente.agencia_id = Agencia.id',
                        )
                ),
                array('table' => 'bloquetos',
                        'alias' => 'Bloqueto',
                        'type' => 'LEFT',
                        'conditions' => array(
                                'Cedente.bloqueto_id = Bloqueto.id',
                        )
                )
        );
        $this->Cedente->recursive = -1;
        $cedente = $this->Cedente->find('first',$options);
        $estados = $this->Estado->find('list');
//        print_r($cedente);exit;

        // ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
        // Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//

        // DADOS DO BOLETO PARA O SEU CLIENTE
        $dias_de_prazo_para_pagamento = $cedente['Bloqueto']['dias_prazo_pagamento'];
        $taxa_boleto = str_replace(',', '.',$cedente['Bloqueto']['taxa_boleto']);//2.95 taxa do boleto
        $data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
        $valor_cobrado = $valor; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
        $valor_cobrado = str_replace(",", ".",$valor_cobrado);
        $valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
        $infor = "";
        if($taxa_boleto > 0)
            $infor = "Valor do pedido R$".number_format($valor,2,',','.').". Taxa do banco R$".number_format($taxa_boleto,2,',','.');

        $dadosboleto["nosso_numero"] = "87654";
        $dadosboleto["numero_documento"] = $id;	// Num do pedido ou do documento
        $dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
        $dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
        $dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
        $dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

        // DADOS DO SEU CLIENTE
        $dadosboleto["sacado"] = $clienteSession['Cliente']['nome'];//"Nome do seu Cliente";
        $dadosboleto["endereco1"] = $clienteSession['Cliente']['logradouro'];//"Endereço do seu Cliente";
        $dadosboleto["endereco2"] = $clienteSession['Cliente']['cidade'].' - '.$clienteSession['Estado']['nome'].' - CEP: '.$clienteSession['Cliente']['cep'];//"Cidade - Estado -  CEP: 00000-000";

        // INFORMACOES PARA O CLIENTE
        $dadosboleto["demonstrativo1"] = $infor;//"Pagamento de Compra na Loja Nonononono";
        $dadosboleto["demonstrativo2"] = "";//"Mensalidade referente a nonon nonooon nononon<br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
        $dadosboleto["demonstrativo3"] = "";//"BoletoPhp - http://www.boletophp.com.br";

        // INSTRUÇÕES PARA O CAIXA
        $dadosboleto["instrucoes1"] = "Só receber até o vencimento.";//"- Sr. Caixa, cobrar multa de 2% após o vencimento";
        $dadosboleto["instrucoes2"] = "";//"- Receber até 10 dias após o vencimento";
        $dadosboleto["instrucoes3"] = "";//"- Em caso de dúvidas entre em contato conosco: xxxx@xxxx.com.br";
        $dadosboleto["instrucoes4"] = "";//"&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br";

        // DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
        $dadosboleto["quantidade"] = "";
        $dadosboleto["valor_unitario"] = "";
        $dadosboleto["aceite"] = "N";
        $dadosboleto["especie"] = "R$";
        $dadosboleto["especie_doc"] = "DM";


        // ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


        // DADOS DA SUA CONTA - BANCO DO BRASIL
        $agencia = explode('-',$cedente['Agencia']['codigo']);
        $conta = explode('-',$cedente['Agencia']['codigo_cedente']);
        $dadosboleto["agencia"] = $agencia[0];//"3463"; // Num da agencia, sem digito
        $dadosboleto["conta"] = $conta[0];//"9036"; 	// Num da conta, sem digito

        // DADOS PERSONALIZADOS - BANCO DO BRASIL
        $dadosboleto["convenio"] = "1500323";  // Num do convênio - REGRA: 6 ou 7 ou 8 dígitos
        $dadosboleto["contrato"] = $cedente['Agencia']['contrato'];//"017943755"; // Num do seu contrato
        $dadosboleto["carteira"] = $cedente['Bloqueto']['carteira'];//"17";
//        $dadosboleto["variacao_carteira"] = "-019";  // Variação da Carteira, com traço (opcional)

        // TIPO DO BOLETO
        $dadosboleto["formatacao_convenio"] = "7"; // REGRA: 8 p/ Convênio c/ 8 dígitos, 7 p/ Convênio c/ 7 dígitos, ou 6 se Convênio c/ 6 dígitos
        $dadosboleto["formatacao_nosso_numero"] = "2"; // REGRA: Usado apenas p/ Convênio c/ 6 dígitos: informe 1 se for NossoNúmero de até 5 dígitos ou 2 para opção de até 17 dígitos

        /*
            #################################################
            DESENVOLVIDO PARA CARTEIRA 18

            - Carteira 18 com Convenio de 8 digitos
              Nosso número: pode ser até 9 dígitos

            - Carteira 18 com Convenio de 7 digitos
              Nosso número: pode ser até 10 dígitos

            - Carteira 18 com Convenio de 6 digitos
              Nosso número:
              de 1 a 99999 para opção de até 5 dígitos
              de 1 a 99999999999999999 para opção de até 17 dígitos

            #################################################
        */


        // SEUS DADOS
        $dadosboleto["identificacao"] = "O pagamento deste boleto também poderá ser efetuado nos terminais de Auto-Atendimento BB";
        if(!empty($cedente['PessoaFisica']['id']))
            $dadosboleto["cpf_cnpj"] = $cedente['PessoaFisica']['cpf'];
        else
            $dadosboleto["cpf_cnpj"] = $cedente['PessoaJuridica']['cnpj'];
        $dadosboleto["endereco"] = $cedente['Cliente']['logradouro'];//"Coloque o endereço da sua empresa aqui";
        $dadosboleto["cidade_uf"] = $cedente['Cliente']['cidade'].' / '.$estados[$cedente['Cliente']['estado_id']];//"Cidade / Estado";
        $dadosboleto["cedente"] = $cedente['Cliente']['nome'];//"Coloque a Razão Social da sua empresa aqui";


        //Dados para geração do código em barras
        $fino = 1 ;
        $largo = 3 ;
        $altura = 50 ;

        $barcodes[0] = "00110" ;
        $barcodes[1] = "10001" ;
        $barcodes[2] = "01001" ;
        $barcodes[3] = "11000" ;
        $barcodes[4] = "00101" ;
        $barcodes[5] = "10100" ;
        $barcodes[6] = "01100" ;
        $barcodes[7] = "00011" ;
        $barcodes[8] = "10010" ;
        $barcodes[9] = "01010" ;
        for($f1=9;$f1>=0;$f1--) {
            for($f2=9;$f2>=0;$f2--) {
                $f = ($f1 * 10) + $f2 ;
                $texto = "" ;
                for($i=1;$i<6;$i++) {
                    $texto .=  substr($barcodes[$f1],($i-1),1) . substr($barcodes[$f2],($i-1),1);
                }
                $barcodes[$f] = $texto;
            }
        }
        $dadosboleto = $this->Boletobb->regras_banco($dadosboleto);
        $this->set(compact('dadosboleto','barcodes', 'fino', 'largo', 'altura'));
    }

}
?>