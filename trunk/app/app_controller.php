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
class AppController extends Controller {

    //Habilite para debug
    //var $components = array('Firephp');
    var $paginate = array('limit' => 10);
    var $redirect = "";
    var $components = array('Session','Auth');

    function beforeFilter() {
        Security::setHash('sha1'); // substitua pelo hash que está usando
        $this->Auth->userModel = 'User'; // nome do seu modelo de usuario
        $this->Auth->fields = array('username' => 'username', 'password' => 'password'); // campos correspondentes a usuario e senha
        $this->Auth->authorize = 'controller';
        $this->Auth->autoRedirect = true; // auto redirecionar
        $this->Auth->loginAction = array('admin'=>false, 'controller' => 'users', 'action' => 'login'); // controlador e action de login
        $this->Auth->loginRedirect = array('controller' => 'shopps', 'action' => 'index'); // controlador e action para enviar o usuario que entrou
        $this->Auth->logoutRedirect = array('admin'=>true, 'controller' => 'users', 'action' => 'logout'); // controlador e action de logout
        $this->Auth->loginError = "Login inválido."; // mensagem de erro
        $this->Auth->authError = "Área restrita, por favor faça login."; // mensagem de acesso restrito
        $this->Auth->usuario = "teste";

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

    function index() {
        $this->getInst();
        $this->Model->recursive = 0;
        $this->set($this->viewPath, $this->paginate());
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
                $this->Session->setFlash(__('ERRO ao salvar '.$this->modelClass.'. Verifique os problemas e tente novamente.', true));
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
                $this->Session->setFlash(__('ERRO ao salvar '.$this->modelClass.'. Verifique os problemas e tente novamente.', true));
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
        if ($this->Model->del($id)) {
            $this->Session->setFlash(__($this->modelClass.' Excluido', true));
            $this->redirect($this->getRedirect());
        }
    }

    function deleteselected($id = null) {
        $this->getInst();
        if (!$id) {
            $this->Session->setFlash(__('Identificador inválido para '.$this->modelClass, true));
            $this->redirect($this->getRedirect());
        }

        if ($this->Model->deleteAll($this->modelClass.".".$this->Model->primaryKey." in (".$id.")")) {
            $this->Session->setFlash(__('Registros excluidos com sucesso', true));
            $this->redirect($this->getRedirect());
        }
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

}
?>