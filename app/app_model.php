<?php
/* SVN FILE: $Id$ */

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppModel extends Model {
    var $displayField = 'nome';
    var $actsAs   = array('transaction', 'Containable');
    var $dbError;
    var $useDbConfig = 'homologacao';


    function formataDateTime($dateTime) {
        $explode = explode(' ', $dateTime);
        $data = $explode[0];
        $hora = $explode[1];

        $explodeData = explode('-', $data);
        $data = $explodeData[2].'-'.$explodeData[1].'-'.$explodeData[0];
        return $data.' '.$hora;
    }

//    public function dateTimeFormate($datetimeString) {
//        $retorno = explode(" ", $datetimeString);
//        if (preg_match("~:~", $retorno[0])) {
//            $hora = explode(":", $retorno[0]);
//            $data = $this->dateFormate($retorno[1]);
//        } else {
//            $hora = explode(":", $retorno[1]);
//            $data = $this->formataDateTime($retorno[0]);
//        }
//        return $data . " " . $hora[0] . ":" . $hora[1] . ":" . $hora[2];
//    }

    public function verificarRelacao($campo, $tabela, $id) {
        $retorno = $this->query("SELECT COUNT(id) FROM ". $tabela ." WHERE  $campo  =  $id");
        return $retorno[0][0]['count'];
    }
    
    function getError() {
        $db =& ConnectionManager::getDataSource($this->useDbConfig);
        $lastError = $db->lastError();
        if(preg_match_all('/"(.+)"/U',$lastError,$matches, PREG_PATTERN_ORDER)){
            $this->errorInit();
            return $this->dbError[$matches[1][0]];
        }
        return false;
    }

    private function errorInit() {
        $this->dbError['cores_uk'] = 'A operação não pode ser concluída, já existe uma <b>Cor</b> com o código informado.';
        $this->dbError['cores_uk2'] = 'A operação não pode ser concluída, já existe uma <b>Cor</b> com o nome informado.';
        $this->dbError['groups_uk'] = 'A operação não pode ser concluída, já existe um <b>Grupo de Acesso</b> com o nome informado.';
        $this->dbError['grupos_uk'] = 'A operação não pode ser concluída, já existe um <b>Segmento</b> com o nome informado.';
        $this->dbError['item_receitas_uk'] = 'A operação não pode ser concluída, já existe um <b>Item de Receita</b> com o nome informado.';
        $this->dbError['itens_uk'] = 'A operação não pode ser concluída, já existe um <b>Item de Produto</b> com o código informado.';
        $this->dbError['permissoes_uk'] = 'A operação não pode ser concluída, já existe uma <b>Permissão</b> com o nome informado.';
        $this->dbError['produtos_uk'] = 'A operação não pode ser concluída, já existe um <b>Produto</b> com o código informado.';
        $this->dbError['produtos_uk2'] = 'A operação não pode ser concluída, já existe um <b>Produto</b> com a descrição informada.';
        $this->dbError['produtos_uk3'] = 'A operação não pode ser concluída, já existe um <b>Produto</b> com a descrição abreviada informada.';
        $this->dbError['receitas_uk'] = 'A operação não pode ser concluída, já existe uma <b>Receita</b> com o nome informado.';
    }
}
?>