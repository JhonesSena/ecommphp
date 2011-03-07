<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
App::import('Core', 'HttpSocket');

class AppController extends Controller {

    //Habilite para debug
    //var $components = array('Firephp');
    var $paginate = array('limit' => 10);
    var $redirect = "";
    var $components = array('Session','Email');
    var $helpers = array('Html','Form','Jquery', 'Menu');
    var $autentication = false;
    var $auth = array();

    function beforeFilter() {
        $filtros = array('off' => 'Mostrar Ativos', 'on' => 'Mostrar Inativos', 'all' => 'Mostrar Todos');
        $this->set(compact('filtros'));
        $clienteSession = $this->Session->read('Usuario');
        $this->set(compact('clienteSession'));
        if(!empty($clienteSession['User']['group_id'])){
            $this->layout = 'default';
            $this->autentication = true;
        }else{
            $this->autentication = true;
            $this->layout = 'cliente';
        }

        $telas = array();
        if($this->Session->check('UserTelas')){
            $telas = $this->Session->read('UserTelas');
        }
        $this->set('telas',$telas);

        if ($this->requiredAutentication() && $this->Autentication() && $this->params['controller'] != 'pages'
                && $this->params['controller'] != 'shopps') {
            if (!$this->validateScreens()) {
                $this->Session->setFlash(__('O Usuário não tem permissão de acesso a página solicitada.', true));
                $this->redirect('/pages/index');
            }
        }

    }

    function requiredAutentication(){
        return true;
    }

    function Autentication($valor = null){
        if($valor != null)
            $this->autentication = $valor;
        else
            return $this->autentication;
    }

    protected function validateScreens() {

        $action = $this->params['action'];
        $controller = $this->params['controller'];
        $controller = strtolower($controller);
        switch ($action) {
            case 'index':
                $action = 'view';
                break;
        }
        $screens = $this->Session->read('UserTelas');
        if(!empty ($this->auth)){
            $screens = Set::merge($screens,$this->auth);
        }
        if (!empty($screens)) {
            $currentUrl = $controller . '/' . $action;
            if (array_key_exists($currentUrl, $screens)) {
                return true;
            }
        }
        return false;
    }

    function isAuthorized () {
        return true;
    }


    /*Metodos protegidos do Controllador*/

    protected function getRedirect() {
        return $this->redirect==""?array('action'=>'index'):$this->redirect;
    }

    protected function setRedirect($red) {
        $this->redirect = $red;
    }

    protected function getInst() {
        array_push($this->helpers,'Jquery');
        $model_class = $this->modelClass;
        $this->Model = $this->$model_class;
    }

    protected function loadbelongsTo(&$Model) {
        if(count($Model->belongsTo)>0) {
            foreach($Model->belongsTo as $key=>$obj) {
                if($obj['className'] == $Model->name) { //Autorelacionamento
                    $plural = Inflector::pluralize(strtolower($Model->name));
                    $Parent = $key;
                    $$plural = $Model->$Parent->find('list');
                    $this->set($plural,$$plural);

                }else {
                    $plural = Inflector::pluralize(strtolower($obj['className']));
                    $$plural = $Model->$obj['className']->find('list');
                    $this->set($plural,$$plural);
                }
            }
        }
    }

    protected function loadhasAndBelongsToMany(&$Model) {
        if(count($Model->hasAndBelongsToMany)>0) {
            foreach($Model->hasAndBelongsToMany as $obj) {
                $plural = Inflector::pluralize(strtolower($obj['className']));
                $$plural = $Model->$obj['className']->find('list');
                $this->set(compact($plural));
            }
        }
    }


    /*Metodos publicos do Controllador*/
    function help() {
        $this->getInst();
        $this->render('/pages/help');
    }

    function index($inativo = 'off', $nome = '') {
        $this->getInst();
        $this->Model->recursive = 1;

        if(!empty($this->data))
        {
            $inativo = $this->data[$this->Model->name]['inativo'];
            $nome = $this->data[$this->Model->name]['nome'];
        }
        if ($inativo == 'on') {
            $retorno = $this->paginate(array('upper('.$this->Model->name.'.'.$this->Model->displayField.') like' => '%'.mb_strtoupper($nome,"utf-8").'%', $this->Model->name.'.ativo'=>false));
            $parametro = array('inativo'=>'on','nome'=>$nome);
        }
        else if ($inativo == 'off') {
            $retorno = $this->paginate(array('upper('.$this->Model->name.'.'.$this->Model->displayField.') like' => '%'.mb_strtoupper($nome,"utf-8").'%', $this->Model->name.'.ativo'=>true));
            $parametro = array('inativo'=>'off','nome'=>$nome);
        }else {
            $retorno = $this->paginate(array('upper('.$this->Model->name.'.'.$this->Model->displayField.') like' => '%'.mb_strtoupper($nome,"utf-8").'%'));
            $parametro = array('inativo'=>'all','nome'=>$nome);
        }
        $this->set($this->viewPath,$retorno);
        $this->set('parametro',$parametro);
    }

    function view($id = null) {
        $this->getInst();
        if (!$id) {
            $this->Session->setFlash(__($this->modelClass.' Invalido.', true));
            $this->redirect($this->getRedirect());
        }
        $this->set($this->modelKey, $this->Model->read(null, $id));
    }

    function add() {
        $this->getInst();
        if (!empty($this->data)) {
            $this->Model->create();
            if ($this->Model->save($this->data)) {
                $this->Session->setFlash(__($this->modelClass.' foi salvo com sucesso.', true));
                $this->redirect($this->getRedirect());
            } else {
                $model = $this->modelClass;
                $db_error = $this->$model->getError();
                if($db_error){
                    $this->Session->setFlash(__($db_error, true));
                }else{
                    $this->Session->setFlash(__('ERRO ao salvar '.$this->modelClass.'. Verifique os problemas e tente novamente.', true));
                }
            }
        }
        $this->loadbelongsTo($this->Model);
        $this->loadhasAndBelongsToMany($this->Model);
    }

    function edit($id = null) {
        $this->getInst();
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__($this->modelClass.' Inválido', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Model->save($this->data)) {
                $this->Session->setFlash(__($this->modelClass.' foi salvo com sucesso', true));
                $this->redirect($this->getRedirect());
            } else {
                $model = $this->modelClass;
                $db_error = $this->$model->getError();
                if($db_error){
                    $this->Session->setFlash(__($db_error, true));
                }else{
                    $this->Session->setFlash(__('ERRO ao salvar '.$this->modelClass.'. Verifique os problemas e tente novamente.', true));
                }
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Model->read(null, $id);
            $this->loadbelongsTo($this->Model);
            $this->loadhasAndBelongsToMany($this->Model);
        }
    }


    function delete($id = null) {
        $this->getInst();
        if (!$id) {
            $this->Session->setFlash(__('Identificador inválido para '.$this->modelClass, true));
            $this->redirect($this->getRedirect());
        }

        $name = $this->modelClass;

        if(array_key_exists('ativo' ,$this->$name->_schema)) {

            //Verifica se o Objeto tem alguma relação que impeça de ser excluido do banco de dados.
            //Caso tenha, ele é inativado (Fazendo um update e passando false no campo ativo do banco).

            $foreignKey = strtolower($name) . "_id";
            $belongsTo = $this->verificaRelacaoBelongsTo($id, $name, $foreignKey);
            $hasMany = $this->verificaRelacaoHasMany($id, $name);
            $hasAndBelongsToMany = $this->verificaRelacaoHABTM($id, $name);


            if($hasMany || $hasAndBelongsToMany || $belongsTo) {
                $dados = array($name=>array('id'=>$id, 'ativo'=>0));
                if ($this->Model->save($dados)) {
                    $this->Session->setFlash(__($name.' Excluido', true));
                    $this->redirect($this->getRedirect());
                }
            }else {
                if ($this->Model->del($id)) {
                    $this->Session->setFlash(__($name.' Excluido', true));
                    $this->redirect($this->getRedirect());
                }
            }
        }else {
            if ($this->Model->del($id)) {
                $this->Session->setFlash(__($name.' Excluido', true));
                $this->redirect($this->getRedirect());
            }
        }

//        if ($this->Model->del($id)) {
//            $this->Session->setFlash(__($this->modelClass.' Excluido', true));
//            $this->redirect($this->getRedirect());
//        }
    }

    function deleteselected($ids = null) {
        $this->getInst();
        if (!$ids) {
            $this->Session->setFlash(__('Identificador inválido para '.$this->modelClass, true));
            $this->redirect($this->getRedirect());
        }
        $ids = explode(',', $ids);
        $excluidos = 0;
        foreach ($ids as $id) {

            $name = $this->modelClass;
            if(array_key_exists('ativo' ,$this->$name->_schema)) {

                //Verifica se o Objeto tem alguma relação que impeça de ser excluido do banco de dados.
                //Caso tenha, ele é inativado (Fazendo um update e passando false no campo ativo do banco).
                $foreignKey = strtolower($name) . "_id";
                $belongsTo = $this->verificaRelacaoBelongsTo($id, $name, $foreignKey);
                $hasMany = $this->verificaRelacaoHasMany($id, $name);
                $hasAndBelongsToMany = $this->verificaRelacaoHABTM($id, $name);

                if($hasMany || $hasAndBelongsToMany || $belongsTo) {
                    $dados = array($name=>array('id'=>$id, 'ativo'=>false));
                    if ($this->Model->save($dados)) {
                        $excluidos++;
                    }
                }else {
                    if ($this->Model->del($id)) {
                        $excluidos++;
                    }
                }
            }else{
                if ($this->Model->del($id)) {
                    $excluidos++;
                }
            }
        }

        if ($excluidos == 1) {
            $this->Session->setFlash(__('Registro excluido com sucesso', true));
            $this->redirect($this->getRedirect());
        }
        else if ($excluidos > 1) {
            $this->Session->setFlash(__('Registros excluidos com sucesso', true));
            $this->redirect($this->getRedirect());
        }
        else {
            $this->Session->setFlash(__('Registros não excluidos', true));
            $this->redirect($this->getRedirect());
        }
//
//        if (!$id) {
//            $this->Session->setFlash(__('Identificador inválido para '.$this->modelClass, true));
//            $this->redirect($this->getRedirect());
//        }
//
//        if ($this->Model->deleteAll($this->modelClass.".".$this->Model->primaryKey." in (".$id.")")) {
//            $this->Session->setFlash(__('Registros excluidos com sucesso', true));
//            $this->redirect($this->getRedirect());
//        }
    }

    //Função para verificar se Formatos tem relacionamentos hasMany.
    function verificaRelacaoHasMany($id, $name) {
        $this->layout = ' ';
        $this->$name->recursive = 2;
        if(!empty($this->$name->hasMany)) {
            foreach ($this->$name->hasMany as $hasMany) {
                $campo = $hasMany['foreignKey'];
                $tabela = $hasMany['className'];
                if ($name == $tabela) {
                    $tabela = $this->$tabela->useTable;
                }else {
                    $tabela = $this->$name->$tabela->useTable;
                }
                $quantidadeRelacao = $this->$name->verificarRelacao($campo, $tabela, $id);
                if ($quantidadeRelacao > 0) {
                    return true;
                }
            }
        }
        return false;
    }

    //Função para verificar se Formatos tem relacionamentos $hasAndBelongsToMany.
    function verificaRelacaoHABTM($id, $name) {
        $this->layout = ' ';
        $this->$name->recursive = 2;
        if(!empty($this->$name->hasAndBelongsToMany)) {
            foreach ($this->$name->hasAndBelongsToMany as $hasAndBelongsToMany) {
                $campo = $hasAndBelongsToMany['foreignKey'];
                $tabela = $hasAndBelongsToMany['joinTable'];
                $quantidadeRelacao = $this->$name->verificarRelacao($campo, $tabela, $id);
                if ($quantidadeRelacao > 0) {
                    return true;
                }
            }
        }
        return false;
    }

    //Função para verificar se Formatos tem relacionamentos $belongsTo.
    function verificaRelacaoBelongsTo($id, $name, $campo2) {
        $this->layout = ' ';
        $this->$name->recursive = 2;

        if(!empty($this->$name->belongsTo)) {
            foreach ($this->$name->belongsTo as $belongsTo) {
                $campo = $belongsTo['foreignKey'];
                if($campo == $campo2) {
                    $tabela = $belongsTo['className'];
                    $tabela = $this->$name->useTable;
                    $quantidadeRelacao = $this->$name->verificarRelacao($campo, $tabela, $id);
                    if ($quantidadeRelacao > 0) {
                    }
                }
            }
        }
        return false;
    }

    /*
	//Habilite para debug
	function beforeRender() { 
		$this->Firephp->info($this);   
	}
    */

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

    function recursiveArraySearch($array, $needle, $index = null) {
        $aIt     = new RecursiveArrayIterator($array);
        $it    = new RecursiveIteratorIterator($aIt);
        while($it->valid()) {
            if (((isset($index) AND ($it->key() == $index)) OR (!isset($index))) AND ($it->current() == $needle)) {
                return $aIt->key()+1;
            }
            $it->next();
        }
        return false;
    }

    function calculaFrete($codServico = '40010', $cepOrigem, $cepDestino, $peso) {
//        $cepOrigem = "42700-000";
//        $cepDestino = "48420-000";
//        $peso = "6";
        $params['resposta'] = 'xml';
        $params['servico'] = $codServico;
        $params['cepOrigem'] = preg_replace('/[^0-9]/', '', $cepOrigem);
        $params['cepDestino'] = preg_replace('/[^0-9]/', '', $cepDestino);
        $params['peso'] = $peso;

        $resto = 0;
        $caixas = 0;

        if($peso > 30) {
            $caixas = (int)($peso / 30);
            $resto = $peso - ($caixas * 30);
        }
        else
            $resto = $peso;
        $url = "http://www.correios.com.br/encomendas/precos/calculo.cfm";
        $HttpSocket = new HttpSocket();
        $valorFinal = 0;
        $pesoFinal = 0;
        if($caixas > 0) {
            for($i = 0; $i < $caixas; $i++) {
                $params['peso'] = 30;//Peso máximo permitido
                $results = $HttpSocket->get($url, $params);
                $results = $this->xmlToArray($results);
                $pesoFinal += $results['calculo_precos']['dados_postais']['peso'];
                $valorFinal += $results['calculo_precos']['dados_postais']['preco_postal'];
            }
        }
        if($resto > 0) {
            $params['peso'] = $resto;
            $results = $HttpSocket->get($url, $params);
            $results = $this->xmlToArray($results);
        }
        $results['calculo_precos']['dados_postais']['peso'] += $pesoFinal;
        $results['calculo_precos']['dados_postais']['preco_postal'] += $valorFinal;
        return $results;
    }

    function enviarEmail($nameFrom, $from, $subject, $msg, $to, $nameTo, $replyTo=null) {
//        $Emailc->SMTPAuth = false;
        /* SMTP Options */
        $this->Email->smtpOptions = array(
                'port' => '465',//587
                'timeout' => '40',
                'host' => 'ssl://smtp.ig.com.br',
                'username' => 'smtp.envio@ig.com.br',
                'password' => 'bocazul1234',
                'client' => 'smtp.ig.com.br');

        /* Define a forma de entrega */
        $this->Email->delivery = 'smtp';

        $this->Email->sendAs = 'html'; // html, text, both
//        $this->set('conteudo', $msg); // especifica variavel da mensagem para o template
        $this->Email->layout = 'default'; // views/elements/email/html/contact.ctp
//        $this->Email->template = 'default';
//
//        //set view variables as normal
//        $this->set('from', $name);
//        $this->set('msg', $msg);
        $this->Email->to = $nameTo . '<' . $to . '>';
        $this->Email->subject = $subject;
        $this->Email->replyTo = $replyTo;
        $this->Email->from = $nameFrom . '<' . $from .'>';

        if ( $this->Email->send($msg) ) {
            return true;

        } else {
            return false;
        }

//        $this->redirect(array('controller'=>'clientes','action'=>'add'));

    }

    function Allow($action = null){
        if($action != null){
            $this->auth[$this->params['controller'].'/'.$action] = true;
        }
    }

}
?>