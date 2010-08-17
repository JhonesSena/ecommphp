<?php
class CorreioComponent extends Object {


    private $url = "http://www.correios.com.br/encomendas/precos/calculo.cfm";

    function calcularPrecoFrete($codServico, $cepOrigem, $cepDestino, $peso) {
        //codigos dos servicos
        //$sedex = "40010";
        
        $codServico = "40010";
        $cepOrigem = "42700-000";
        $cepDestino = "48420-000";
        $peso = "6";
        
        $params['resposta'] = 'xml';
        $params['servico'] = $codServico;
        $params['cepOrigem'] = preg_replace('/[^0-9]/', '', $cepOrigem);
        $params['cepDestino'] = preg_replace('/[^0-9]/', '', $cepDestino);
        $params['peso'] = $peso;

        $result = array();
        $result = $this->request('get',array('url' => $this->url,'data' => $params));
//        $result = $this->xmlToArray($result);
        return $result;
    }
    
    function xmlToArray($xml) {
        $reels = '/<(\w+)\s*([^\/>]*)\s*(?:\/>|>(.*)<\/\s*\\1\s*>)/s';
        $reattrs = '/(\w+)=(?:"|\')([^"\']*)(:?"|\')/';
        preg_match_all($reels, $xml, $elements);
        $array = array();
        $nodes = $elements['1'];
        $tags = $elements['3'];
        foreach($nodes as $key => $node) {
            if (preg_match($reels, $tags[$key])) {
                $array[$node] = $this->xmlToArray($tags[$key]);
            }else {
                $array[$node] = $tags[$key];
            }
        }
        return $array;
    }
}
?>
