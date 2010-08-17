<?php
class BoletobbComponent extends Object {

    // +----------------------------------------------------------------------+
    // | BoletoPhp - Versão Beta                                              |
    // +----------------------------------------------------------------------+
    // | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
    // | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
    // | Você deve ter recebido uma cópia da GNU Public License junto com     |
    // | esse pacote; se não, escreva para:                                   |
    // |                                                                      |
    // | Free Software Foundation, Inc.                                       |
    // | 59 Temple Place - Suite 330                                          |
    // | Boston, MA 02111-1307, USA.                                          |
    // +----------------------------------------------------------------------+

    // +----------------------------------------------------------------------+
    // | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
    // | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
    // | PHPBoleto de João Prado Maia e Pablo Martins F. Costa				  |
    // | 																	  |
    // | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
    // | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
    // +----------------------------------------------------------------------+

    // +-------------------------------------------------------------------------------------------------------------------------+
    // | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>              					                               |
    // | Desenvolvimento Boleto Banco do Brasil: Daniel William Schultz / Leandro Maniezo / Rogério Dias Pereira / Romeu Medeiros|
    // +-------------------------------------------------------------------------------------------------------------------------+


    function regras_banco($dadosboleto) {
        $codigobanco = "001";
        $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
        $nummoeda = "9";
        $fator_vencimento = $this->fator_vencimento($dadosboleto["data_vencimento"]);

        //valor tem 10 digitos, sem virgula
        $valor = $this->formata_numero($dadosboleto["valor_boleto"],10,0,"valor");
        //agencia é sempre 4 digitos
        $agencia = $this->formata_numero($dadosboleto["agencia"],4,0);
        //conta é sempre 8 digitos
        $conta = $this->formata_numero($dadosboleto["conta"],8,0);
        //carteira 18
        $carteira = $dadosboleto["carteira"];
        //agencia e conta
        $agencia_codigo = $agencia."-". $this->modulo_11($agencia) ." / ". $conta ."-". $this->modulo_11($conta);
        //Zeros: usado quando convenio de 7 digitos
        $livre_zeros='000000';

        // Carteira 18 com Convênio de 8 dígitos
        if ($dadosboleto["formatacao_convenio"] == "8") {
            $convenio = $this->formata_numero($dadosboleto["convenio"],8,0,"convenio");
            // Nosso número de até 9 dígitos
            $nossonumero = $this->formata_numero($dadosboleto["nosso_numero"],9,0);
            $dv=$this->modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira");
            $linha="$codigobanco$nummoeda$dv$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira";
            //montando o nosso numero que aparecerá no boleto
            $nossonumero = $convenio . $nossonumero ."-". $this->modulo_11($convenio.$nossonumero);
        }

        // Carteira 18 com Convênio de 7 dígitos
        if ($dadosboleto["formatacao_convenio"] == "7") {
            $convenio = $this->formata_numero($dadosboleto["convenio"],7,0,"convenio");
            // Nosso número de até 10 dígitos
            $nossonumero = $this->formata_numero($dadosboleto["nosso_numero"],10,0);
            $dv=$this->modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira");
            $linha="$codigobanco$nummoeda$dv$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira";
            $nossonumero = $convenio.$nossonumero;
            //Não existe DV na composição do nosso-número para convênios de sete posições
        }

        // Carteira 18 com Convênio de 6 dígitos
        if ($dadosboleto["formatacao_convenio"] == "6") {
            $convenio = $this->formata_numero($dadosboleto["convenio"],6,0,"convenio");

            if ($dadosboleto["formatacao_nosso_numero"] == "1") {

                // Nosso número de até 5 dígitos
                $nossonumero = $this->formata_numero($dadosboleto["nosso_numero"],5,0);
                $dv = $this->modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$convenio$nossonumero$agencia$conta$carteira");
                $linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$convenio$nossonumero$agencia$conta$carteira";
                //montando o nosso numero que aparecerá no boleto
                $nossonumero = $convenio . $nossonumero ."-". $this->modulo_11($convenio.$nossonumero);
            }

            if ($dadosboleto["formatacao_nosso_numero"] == "2") {

                // Nosso número de até 17 dígitos
                $nservico = "21";
                $nossonumero = $this->formata_numero($dadosboleto["nosso_numero"],17,0);
                $dv = $this->modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$convenio$nossonumero$nservico");
                $linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$convenio$nossonumero$nservico";
            }
        }

        $dadosboleto["codigo_barras"] = $linha;
        $dadosboleto["linha_digitavel"] = $this->monta_linha_digitavel($linha);
        $dadosboleto["agencia_codigo"] = $agencia_codigo;
        $dadosboleto["nosso_numero"] = $nossonumero;
        $dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;

        return $dadosboleto;
    }


    // FUNÇÕES
    // Algumas foram retiradas do Projeto PhpBoleto e modificadas para atender as particularidades de cada banco

    function formata_numero($numero,$loop,$insert,$tipo = "geral") {
        if ($tipo == "geral") {
            $numero = str_replace(",","",$numero);
            while(strlen($numero)<$loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "valor") {
            /*
                        retira as virgulas
                        formata o numero
                        preenche com zeros
            */
            $numero = str_replace(",","",$numero);
            while(strlen($numero)<$loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "convenio") {
            while(strlen($numero)<$loop) {
                $numero = $numero . $insert;
            }
        }
        return $numero;
    }



    function fator_vencimento($data) {
        $data = split("/",$data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
        return(abs(($this->dateToDays("1997","10","07")) - ($this->dateToDays($ano, $mes, $dia))));
    }

    function dateToDays($year,$month,$day) {
        $century = substr($year, 0, 2);
        $year = substr($year, 2, 2);
        if ($month > 2) {
            $month -= 3;
        } else {
            $month += 9;
            if ($year) {
                $year--;
            } else {
                $year = 99;
                $century --;
            }
        }

        return ( floor((  146097 * $century)    /  4 ) +
                        floor(( 1461 * $year)        /  4 ) +
                        floor(( 153 * $month +  2) /  5 ) +
                        $day +  1721119);
    }

    /*
        #################################################
        FUNÇÃO DO MÓDULO 10 RETIRADA DO PHPBOLETO

        ESTA FUNÇÃO PEGA O DÍGITO VERIFICADOR DO PRIMEIRO, SEGUNDO
        E TERCEIRO CAMPOS DA LINHA DIGITÁVEL
        #################################################
            */
            function modulo_10($num) {
                $numtotal10 = 0;
                $fator = 2;

                for ($i = strlen($num); $i > 0; $i--) {
                    $numeros[$i] = substr($num,$i-1,1);
                    $parcial10[$i] = $numeros[$i] * $fator;
                    $numtotal10 .= $parcial10[$i];
                    if ($fator == 2) {
                        $fator = 1;
                    }
                    else {
                        $fator = 2;
                    }
                }

        $soma = 0;
        for ($i = strlen($numtotal10); $i > 0; $i--) {
                    $numeros[$i] = substr($numtotal10,$i-1,1);
                    $soma += $numeros[$i];
                }
                $resto = $soma % 10;
                $digito = 10 - $resto;
                if ($resto == 0) {
                    $digito = 0;
        }

                    return $digito;
    }

    /*
        #################################################
        FUNÇÃO DO MÓDULO 11 RETIRADA DO PHPBOLETO

        MODIFIQUEI ALGUMAS COISAS...

        ESTA FUNÇÃO PEGA O DÍGITO VERIFICADOR:

        NOSSONUMERO
        AGENCIA
        CONTA
        CAMPO 4 DA LINHA DIGITÁVEL
        #################################################
    */

    function modulo_11($num, $base=9, $r=0) {
        $soma = 0;
        $fator = 2;
        for ($i = strlen($num); $i > 0; $i--) {
            $numeros[$i] = substr($num,$i-1,1);
            $parcial[$i] = $numeros[$i] * $fator;
            $soma += $parcial[$i];
            if ($fator == $base) {
                $fator = 1;
            }
            $fator++;
        }
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;

            //corrigido
            if ($digito == 10) {
                $digito = "X";
            }

            /*
                        alterado por mim, Daniel Schultz

                        Vamos explicar:

                        O módulo 11 só gera os digitos verificadores do nossonumero,
                        agencia, conta e digito verificador com codigo de barras (aquele que fica sozinho e triste na linha digitável)
                        só que é foi um rolo...pq ele nao podia resultar em 0, e o pessoal do phpboleto se esqueceu disso...

                        No BB, os dígitos verificadores podem ser X ou 0 (zero) para agencia, conta e nosso numero,
                        mas nunca pode ser X ou 0 (zero) para a linha digitável, justamente por ser totalmente numérica.

                        Quando passamos os dados para a função, fica assim:

                        Agencia = sempre 4 digitos
                        Conta = até 8 dígitos
                        Nosso número = de 1 a 17 digitos

                        A unica variável que passa 17 digitos é a da linha digitada, justamente por ter 43 caracteres

                        Entao vamos definir ai embaixo o seguinte...

                        se (strlen($num) == 43) { não deixar dar digito X ou 0 }
            */

            if (strlen($num) == "43") {
                //então estamos checando a linha digitável
                if ($digito == "0" or $digito == "X" or $digito > 9) {
                    $digito = 1;
                }
            }
            return $digito;
        }
        elseif ($r == 1) {
            $resto = $soma % 11;
            return $resto;
        }
    }

    /*
        Montagem da linha digitável - Função tirada do PHPBoleto
        Não mudei nada
    */
    function monta_linha_digitavel($linha) {
        // Posição 	Conteúdo
        // 1 a 3    Número do banco
        // 4        Código da Moeda - 9 para Real
        // 5        Digito verificador do Código de Barras
        // 6 a 19   Valor (12 inteiros e 2 decimais)
        // 20 a 44  Campo Livre definido por cada banco

        // 1. Campo - composto pelo código do banco, código da moéda, as cinco primeiras posições
        // do campo livre e DV (modulo10) deste campo
        $p1 = substr($linha, 0, 4);
        $p2 = substr($linha, 19, 5);
        $p3 = $this->modulo_10("$p1$p2");
        $p4 = "$p1$p2$p3";
        $p5 = substr($p4, 0, 5);
        $p6 = substr($p4, 5);
        $campo1 = "$p5.$p6";

        // 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($linha, 24, 10);
        $p2 = $this->modulo_10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo2 = "$p4.$p5";

        // 3. Campo composto pelas posicoes 16 a 25 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($linha, 34, 10);
        $p2 = $this->modulo_10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo3 = "$p4.$p5";

        // 4. Campo - digito verificador do codigo de barras
        $campo4 = substr($linha, 4, 1);

        // 5. Campo composto pelo valor nominal pelo valor nominal do documento, sem
        // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
        // tratar de valor zerado, a representacao deve ser 000 (tres zeros).
        $campo5 = substr($linha, 5, 14);

        return "$campo1 $campo2 $campo3 $campo4 $campo5";
    }

    function geraCodigoBanco($numero) {
        $parte1 = substr($numero, 0, 3);
        $parte2 = $this->modulo_11($parte1);
        return $parte1 . "-" . $parte2;
    }

}
?>
